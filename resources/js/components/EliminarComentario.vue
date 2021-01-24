<template>
    <input type="submit" class="btn btn-danger btn-sm mr-2" value="Eliminar" v-on:click="eliminarComentario">           
</template>

<script>
export default {
    props:['comentarioId'],
    methods:{
        eliminarComentario(){
            this.$swal({
            title: 'Quieres eliminar este comentario?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.comentarioId
                }
                axios.post(`/admin/comentarios/${this.comentarioId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminado!',
                'El comentario ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>