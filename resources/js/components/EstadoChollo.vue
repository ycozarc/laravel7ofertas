<template>
    <span 
    class="" :class="claseEstadoChollo()"
    @click="cambiarEstado"
    :key="estadoCholloData"
    >       
    {{ estadoChollo }}
    </span>
</template>

<script>
export default {
    props:['estado', 'cholloId'],
    mounted(){
        this.estadoCholloData = Number(this.estado)
    },
    data: function(){
        return {
            estadoCholloData: null
        }
    },
    methods:{
        claseEstadoChollo(){
            return this.estadoCholloData === 1 ? "badge badge-success" : "badge badge-danger"
        },
        cambiarEstado(){
            if(this.estadoCholloData === 1){
                this.estadoCholloData = 0;
            }else{
                this.estadoCholloData = 1;
            }

            //Enviar a axios
            const params = {
                estado: this.estadoCholloData
            }
            axios
                .post('/chollos/' + this.cholloId, params)
                .then(respuesta => console.log(respuesta))
                .catch(error => console.log(error))
        }
    },
    computed:{
        estadoChollo(){
            return this.estadoCholloData === 1 ? 'Activo' : 'Caducado'
        }
    }
}
</script>