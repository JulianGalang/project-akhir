
  function toggleDropdown(id) {
    const dropdown = document.getElementById(id);
    const icon = document.getElementById(id + 'Icon');

    // Toggle visibility of the dropdown menu
    dropdown.classList.toggle('hidden');

    // Toggle the rotation of the icon
    icon.classList.toggle('rotate-180');
  }

  // Menutup dropdown jika klik di luar area dropdown
  window.addEventListener('click', (e) => {
    const dropdownMenu = document.querySelectorAll('.hidden');
    const button = document.querySelectorAll('button');

    dropdownMenu.forEach((menu) => {
      if (!e.target.closest('li') && !e.target.closest('button')) {
        menu.classList.add('hidden');
        // Reset icon rotation if closed
        const icon = menu.previousElementSibling.querySelector('svg');
        icon.classList.remove('rotate-180');
      }
    });
  });
