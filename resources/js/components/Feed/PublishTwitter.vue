<template>
    <div class="ui form">
        <h1 class="ui header">Publicar</h1>
        <div class="field">
            <textarea v-model="content" class="no-resize" rows="4" placeholder="Criar uma publicação..."></textarea>
            <button :class="['ui primary button', {loading:loading}]" @click="publicar">Publicar</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            content:"",
            loading: false,
        }
    },
    methods: {
        publicar() {
            this.loading = true;
            axios.post("/posts", {content:this.content})
            .then(response => {
                this.$emit("nova-publicacao", response.data);
            })
            .catch(error => {

            })
            .finally(() => {
                this.loading = false;
                this.content = "";
            });
        }
    }
}
</script>

<style lang="scss" scoped>
.form {
    margin-bottom: 3.2rem;
    .field {
        text-align: right;
        button {
            margin-top: 5px;
        }
    }
}

</style>