<template>
    <input type="submit" class="btn btn-danger btn-sm" value="Eliminar" v-on:click="eliminarUser">           
</template>

<script>
export default {
    props:['userId'],
    methods:{
        eliminarUser(){
            this.$swal({
            title: 'Quieres eliminar este usuario?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.userId
                }
                axios.post(`/admin/usuarios/${this.userId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminado!',
                'Tu usuario ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>