<template>
    <div class="div-perfil">
        <p class="text-white">Olá, {{user.name}}</p>
        <h3 class="ui text-white header">Sugestões para você seguir</h3>
        <div v-if="profiles.length" class="ui middle aligned divided list">
            <div class="item" v-for="profile in profiles" :key="profile.id">
                <div class="content name">
                    {{profile.name}}
                </div>
                <button v-if="profile.following" class="ui disabled button">
                    <i class="user icon"></i>
                    Seguindo
                </button>
                <div class="content" v-else>
                    <div class="ui button" @click="follow(profile)">Seguir</div>
                </div>
            </div>
        </div>
        <small v-else class="text-white">Nenhuma sugestão encontrada!</small>
    </div>
</template>

<script>
export default {
    props: ["user"],
    data() {
        return {
            profiles: []
        }
    },
    methods: {
        getProfiles() {
            axios.get("/users/profiles")
            .then(response => {
                this.profiles = response.data;
            })
        },
        follow({name, id}) {
            axios.post(`/users/${id}/follow`)
            .then(response => {
                SnackBar({
                    message: `Agora você está seguindo ${name}`,
                    status: "success"
                });

                const profileIndex = this.profiles.findIndex(profile => profile.id == id);

                const profile = this.profiles[profileIndex];

                profile.following = true;

                Vue.set(this.profiles, profileIndex, profile);

                setTimeout(() => {
                    this.profiles.splice(profileIndex, 1);
                }, 2000);

            })
            .catch(error => {
                SnackBar({
                    message: error.response.data.message,
                    status:"error"
                })
            });
        }
    },
    created() {
        this.getProfiles();
    }
}
</script>

<style scoped lang="scss">
.link {
    position:absolute;
    bottom:0;
    margin-bottom: 25px;
    width: 100%;
    font-size: 16px;
    a {
        text-decoration: none;
        color:white;
    }
}

.div-perfil {
    position: fixed;
    left: 0;
    top: 40px;
    background: #2185d0;
    height: calc(100vh - 40px);
    width: 20%;
    padding: 1.6rem;
    .item {
        display:flex;
        justify-content: space-between;
        align-items: center;
    }
}

.perfil {
    margin-bottom: 32px;
}

.name {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style>