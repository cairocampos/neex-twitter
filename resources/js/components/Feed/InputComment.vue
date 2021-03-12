<template>
  <div class="extra content">
        <div class="ui large transparent right icon input w-100">
        <input v-model="content" type="text w-100" placeholder="Adicionar comentário">
        <button :class="['circular ui icon button primary', {loading:loading}]" @click="comentar">
            <i class="paper plane outline icon"></i>
        </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        post_id: {
            type: Number|String,
            required:true
        },
        comments_count: {
            type: Number|String,
            required:true
        }
    },
    data() {
        return {
            loading:false,
            content: ""
        }
    },
    methods: {
        comentar() {
            this.loading = true;
            axios.post("/comments", {
                post_id: this.post_id,
                content: this.content

            })
            .then(response => {
                this.$emit("update-comments", response.data);
            })
            .catch(error => {

            })
            .finally(() => {
                this.loading = false;
                this.content = "";
            })
        }
    }
}
</script>

<style>

</style>