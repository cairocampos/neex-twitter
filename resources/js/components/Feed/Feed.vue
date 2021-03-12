<template>
  <div class="div-feed">
      <PublishTwitter @nova-publicacao="inserePost" />
      <Posts :nova-publicacao="novaPublicacao" />
  </div>
</template>

<script>
import PublishTwitter from "./PublishTwitter";
import Posts from "./Posts";
export default {
    components: {
        PublishTwitter,
        Posts
    },
    data() {
        return {
            novaPublicacao: {}
        }
    },
    methods: {
        inserePost(post)
        {
            this.novaPublicacao = post;
        }
    }
}
</script>

<style>

</style>