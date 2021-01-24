<template>
<div>
    <div><span class="like-text">a {{ numLikes }} les gustó esto</span></div>
  <div><span class="like-btn" @click="likeChollo" :class="{ 'like-active' : isActive }"></span></div>
</div>
</template>

<script>
    export default {
        props: ['cholloId', 'like', 'likes'],
        data: function() {
            return {
                isActive: this.like,
                totalLikes: this.likes
            }
        },
        methods: {
            likeChollo() {
                axios.put('/chollo/' + this.cholloId)
                    .then(respuesta => {
                        
                        if(respuesta.data.attached.length > 0 ) {
                            this.$data.totalLikes++;
                        } else {
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive
                    })
                    .catch(error => {
                        if(error.response.status === 401) {
                            window.location = '/login';
                        }
                    });
            }
        }, 
        computed: {
            numLikes: function() {
                return this.totalLikes
            }
        }
    }
</script>