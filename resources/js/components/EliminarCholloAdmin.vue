<template>
    <input type="submit" class="btn btn-danger btn-sm" value="Eliminar" v-on:click="eliminarChollo">           
</template>

<script>
export default {
    props:['cholloId'],
    methods:{
        eliminarChollo(){
            this.$swal({
            title: 'Quieres eliminar este chollo?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.cholloId
                }
                axios.post(`/admin/chollos/${this.cholloId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminado!',
                'Tu chollo ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>