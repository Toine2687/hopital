// Affichage mise à jour patient
const updateSection = document.getElementById('update')
const modifyPic = document.getElementById('modifyPic')
const updateAppointment = document.getElementById('updateAppointment')
const modifyAppointment = document.getElementById('modifyAppointment')
// const deleteAppointment = document.getElementById('deleteAppointment')

if (typeof (modifyPic) != 'undefined' && modifyPic != null) {
    modifyPic.addEventListener('click', () => {
        updateSection.classList.toggle('hidden')
    })
}

if (typeof (modifyAppointment) != 'undefined' && modifyAppointment != null) {
    modifyAppointment.addEventListener('click', () => {
        updateAppointment.classList.toggle('hidden')
    })
}

