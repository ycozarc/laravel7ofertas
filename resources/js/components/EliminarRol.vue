<template>
    <input type="submit" class="btn btn-danger btn-sm mr-2" value="Eliminar" v-on:click="eliminarRol">           
</template>

<script>
export default {
    props:['rolId'],
    methods:{
        eliminarRol(){
            this.$swal({
            title: 'Quieres eliminar este rol?',
            text: "No se podrá recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.isConfirmed) {
                const params = {
                    id: this.rolId
                }
                axios.post(`/admin/roles/${this.rolId}`, {params, _method: 'delete'})
                this.$swal(
                'Eliminado!',
                'El rol ha sido eliminado.',
                'success'
                )
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
            }
            })
        }
    }
}
</script>