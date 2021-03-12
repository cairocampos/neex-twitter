<template>
  <div class="content">
    <div class="content">
        <div class="right floated meta">
            {{moment(post.createt_at).startOf('hour').fromNow()}}
            <!-- {{moment(post.created_at).calendar()}} -->
        </div>
        <i class="user icon"></i> {{post.user.name}}
        
        <a 
            @click="unfollow" 
            v-if="!post.user.unfollow && $store.state.user.id != post.user.id">
            - Deixar de seguir</a>
    </div>
    <div class="content">
        {{post.content}}
    </div>
    <div class="content comments_count">
        <div v-if="!showComments" @click="showComments = true">
            <i class="comment icon"></i>
            {{post.comments_count}} Comentários
        </div>
        <div v-else>
            <button class="ui button red" @click="showComments = false">Fechar</button>
        </div>
    </div>

    <transition name="fade-left">
        <Comentarios 
            v-if="showComments" 
            :post_id="post.id" 
            @closeModal="modalComentariosAtivo = false" 
            :novo_comentario="novo_comentario"
            />
    </transition>

    <InputComment 
        :post_id="post.id" 
        :comments_count="post.comments_count" 
        @update-comments="updateComments"/>
  </div>
</template>

<script>
import InputComment from "./InputComment"
import Comentarios from "./Modal/Comentarios";
export default {
    props:{
        post: {
            type: Object,
            required:true
        }
    },
    data() {
        return {
            showComments:false,
            novo_comentario: {}
        }
    },
    components: {
        InputComment,
        Comentarios
    },
    methods: {
        updateComments(comment) {
            this.post.comments_count = parseInt(this.post.comments_count) + 1;
            this.novo_comentario = comment;
            console.log(comment);
        },
        unfollow() {
            axios.post(`/users/${this.post.user.id}/unfollow`)
            .then(response => {
                this.$emit("event-unfollow", this.post.user.id)
            })
            .catch((error) => {
                SnackBar({
                    message: error.response.data.message,
                    status:"error"
                })
            })
        }
    }
}
</script>

<style scoped>
.comments_count {
    cursor: pointer;
}

</style>