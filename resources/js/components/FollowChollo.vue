<template>
    <span 
    class="" :class="claseFollowChollo()"
    @click="estadoBoton"
    :key="estadoCholloData"
    >
    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5V2z"/>
</svg>       
    {{ estadoChollo }}
    </span>
</template>

<script>
export default {
    props:['follow', 'cholloId'],
    mounted(){
        this.estadoCholloData = Number(this.follow)
    },
    data: function(){
        return {
            estadoCholloData: null
        }
    },
    methods:{
        claseFollowChollo(){
            return this.estadoCholloData === 1 ? "btn btn-link pl-0 text-primary font-weight-bold" : "btn btn-link pl-0 text-secondary font-weight-bold"
        },
        estadoBoton(){
            if(this.estadoCholloData === 1){
                this.estadoCholloData = 0;
            }else{
                this.estadoCholloData = 1;
            }

            //Enviar a axios
            axios
                .put('/chollof/' + this.cholloId)
                .then(respuesta => console.log(respuesta))
                .catch(error => {
                        if(error.response.status === 401) {
                            window.location = '/login';
                        }
                    });
        }
    },
    computed:{
        estadoChollo(){
            return this.estadoCholloData === 1 ? 'Quitar de chollos guardados' : 'Guardar chollo'
        }
    }
}
</script>