document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.getElementById('logoutButton');
    const confirmationPopup = document.getElementById('logout-confirmation');
    const overlay = document.getElementById('overlay');
    const cancelButton = document.getElementById('button-cancel');

    function showPopup() {
        confirmationPopup.classList.remove('hidden');
        overlay.classList.remove('hidden');
    }

    function hidePopup() {
        confirmationPopup.classList.add('hidden');
        overlay.classList.add('hidden');
    }

    logoutButton.addEventListener('click', showPopup);
    cancelButton.addEventListener('click', hidePopup);
    overlay.addEventListener('click', hidePopup);
});
