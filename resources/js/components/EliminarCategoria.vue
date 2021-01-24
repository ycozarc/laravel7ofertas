<template>
    <input type="submit" class="btn btn-danger btn-sm mr-2" value="Eliminar" v-on:click="eliminarCategoria">           
</template>

<script>
export default {
    props:['categoriaId'],
    methods:{
        eliminarCategoria(){
            this.$swal({
            title: 'Quieres eliminar esta categoría?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.categoriaId
                }
                axios.post(`/admin/categorias/${this.categoriaId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminada!',
                'La categoría ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>