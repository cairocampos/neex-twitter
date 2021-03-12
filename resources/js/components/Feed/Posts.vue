<template>
    <div class="posts">
      <h1 class="ui header">Feed</h1>
        <transition-group name="fade-left" v-if="posts && posts.length" tag="div">
          <div v-for="post in posts" :key="post.id">
            <PostItem class="ui card" :post="post" @event-unfollow="unfollowing" />
          </div>
        </transition-group>
        <div v-observe-visibility="visibilityChanged" v-if="!hasNextPage" key="observe">...</div>
        <p v-if="!loading && !posts.length">
          Nenhum post encontrado!
        </p>
    </div>
</template>

<script>
import paginate from "../../mixins/paginate"
import PostItem from "./PostItem";
export default {
  props: ["novaPublicacao"],
  mixins:[paginate],
  data() {
    return {
      loading:false,
      posts: [],
    }
  },
  components: {
    PostItem
  },
  watch: {
    page(current_page) {
      this.meta.current_page = current_page;
      this.getFeed();
    },
    novaPublicacao(post) {
      if(Object.keys(post).length) {
        this.posts.unshift(post);
      }
    },
  },
  methods: {
    getFeed() {
      let params = {};
      params.page = this.meta.current_page;
      this.loading = true;
      axios.get("/feed", {params})
      .then(response => {
        const {data} = response;
        if(data.data.length) {
            const posts = data.data.map(post => {
              post.user.unfollow = false;
              return post;
            })
            this.posts.push(...posts);
        }
        let {current_page, last_page} = data;
        this.meta = {current_page, last_page};
      })
      .catch(error => {
        console.log(error);
      })
      .finally(() => this.loading = false);
    },
    unfollowing(user_id) {
      this.posts.forEach((post, index) => {
        if(post.user.id == user_id) {
          post.user.unfollow = true;
          this.posts[index] = post;
        }
      });

      
    }
  },
  created() {
    this.getFeed();
  }
}
</script>

<style lang="scss" scoped>
.ui {
  .card {
    width:100%;
    margin-bottom: 1.6rem;
    .content {
      padding: 1.6rem;
    }
  }
}

</style>