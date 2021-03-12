<template>
    <div class="content">
        <div v-if="comments.length" class="ui comments content" ref="scrollable">
            <div class="comment" v-for="comment in comments" :key="comment.id">
                <a class="avatar">
                    <i class="user icon"></i>
                </a>
                <div class="content">
                    <a class="author">{{comment.user.name}}</a>
                    <div class="metadata">
                        <div class="date">{{moment(comment.created_at).calendar()}}</div>
                    </div>
                    <div class="text">
                        {{comment.content}}.
                    </div>
                    <div class="actions">
                        <a class="reply">Responder</a>
                    </div>
                </div>
            </div>
        </div>
        <p v-else>Nenhum comentário encontrado para esse post!</p>
    </div>
</template>

<script>
export default {
    props: {
        post_id: {
            required:true
        },
        novo_comentario: {
            type: Object
        }
    },
    data() {
        return {
            loading:true,
            comments: [],
            teste:false
        }
    },
    watch: {
        novo_comentario(comment) {
            this.comments.push(comment);
            setTimeout(() => {
                let scrollHeight = this.$refs.scrollable.scrollHeight || 0;
                this.$refs.scrollable.scrollTo({
                    top: scrollHeight * 2,
                })
                SnackBar({
                    message: `Você adicionou um novo comentário!`,
                    status: "success"
                });

            }, 1000);
        }
    },
    methods: {
        getComments() {
            this.loading = true;
            axios.get(`posts/${this.post_id}/comments`)
            .then(response => {
                this.comments = response.data;
            })
            .finally(() => {
                this.loading = false;
            })
        },
    },
    created() {
       this.getComments();
    }
}
</script>

<style scoped>
.modal-body {
    max-height: 500px;
    overflow-y: auto;
}

.comments {
    max-width: 100% !important;
    max-height: 300px;
    overflow-y: auto;
}

</style>