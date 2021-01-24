<template>
    <span 
    class="" :class="claseModeradoChollo()"
    @click="cambiarModerado"
    :key="moderadoCholloData"
    >       
    {{ moderadoChollo }}
    </span>
</template>

<script>
export default {
    props:['moderado', 'cholloId'],
    mounted(){
        this.moderadoCholloData = Number(this.moderado)
    },
    data: function(){
        return {
            moderadoCholloData: null
        }
    },
    methods:{
        claseModeradoChollo(){
            return this.moderadoCholloData === 1 ? "badge badge-success" : "badge badge-warning"
        },
        cambiarModerado(){
            if(this.moderadoCholloData === 1){
                this.moderadoCholloData = 0;
            }else{
                this.moderadoCholloData = 1;
            }

            //Enviar a axios
            const params = {
                moderado: this.moderadoCholloData
            }
            axios
                .post('/admin/chollos/moderado/' + this.cholloId, params)
                .then(respuesta => console.log(respuesta))
                .catch(error => console.log(error))
        }
    },
    computed:{
        moderadoChollo(){
            return this.moderadoCholloData === 1 ? 'Verificado' : 'Esperando moderación'
        }
    }
}
</script>