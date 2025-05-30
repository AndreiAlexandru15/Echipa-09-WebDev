document.addEventListener('DOMContentLoaded', function () {
  UIkit.notification({
    message: 'Bine ai venit pe pagina principală!',
    status: 'success',
    pos: 'top-center',
    timeout: 2500
  })

  var programareBtn = document.querySelector('a.uk-button-primary.uk-button-large[href="contact.html"]')
  if (programareBtn) {
    programareBtn.addEventListener('click', function () {
      UIkit.notification({
        message: 'Navighezi către pagina de programare!',
        status: 'primary',
        pos: 'top-center',
        timeout: 1500
      })
    })
  }
}) 