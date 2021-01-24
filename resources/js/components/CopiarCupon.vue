<template>
                <div class="d-flex justify-content-between">
                    <span class="mt-2 ml-2 mr-4 font-weight-bold">{{ codigoCupon }}</span>
                    <span class="btn copy-btn ml-auto" :class="activo==true?' btn-primary':'btn-secondary'" @click.stop.prevent="copyCode">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-scissors" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3.5 3.5c-.614-.884-.074-1.962.858-2.5L8 7.226 11.642 1c.932.538 1.472 1.616.858 2.5L8.81 8.61l1.556 2.661a2.5 2.5 0 1 1-.794.637L8 9.73l-1.572 2.177a2.5 2.5 0 1 1-.794-.637L7.19 8.61 3.5 3.5zm2.5 10a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm7 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
</svg>
                    </span>
                    <input type="hidden" :id="idChollo" :value="codigoCupon">
                </div>
</template>

<script>
export default {
    props:['cupon', 'cholloId','activo'],
    data: function(){
        return {
            codigoCupon: this.cupon,
            idChollo: `chollo${this.cholloId}`,
        }
    },
    methods: {
        copyCode () {
          let cuponCopiar = document.querySelector(`#chollo${this.cholloId}`)
          cuponCopiar.setAttribute('type', 'text')    
          cuponCopiar.select()

          try {
            var successful = document.execCommand('copy');
            this.$swal({
                position: 'center',
                icon: 'success',
                title: 'Cupón copiado',
                showConfirmButton: false,
                timer: 1500
            })
          } catch (err) {
            alert('Error al copiar');
          }

          cuponCopiar.setAttribute('type', 'hidden')
          window.getSelection().removeAllRanges()
        },
    },
}
</script>