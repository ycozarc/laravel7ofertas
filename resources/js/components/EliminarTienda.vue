<template>
    <input type="submit" class="btn btn-danger btn-sm mr-2" value="Eliminar" v-on:click="eliminarTienda">           
</template>

<script>
export default {
    props:['tiendaId'],
    methods:{
        eliminarTienda(){
            this.$swal({
            title: 'Quieres eliminar esta tienda?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.tiendaId
                }
                axios.post(`/admin/tiendas/${this.tiendaId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminada!',
                'La tienda ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>