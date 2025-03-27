import 'flowbite';
 
const showChildComents_button = document.querySelectorAll('[id^="showChildComments-"]');
const childComents_containers = document.querySelectorAll('[id^="childComments_container-"]')

showChildComents_button.forEach((button, index) => {
    const childComents_container = childComents_containers[index];

    button.addEventListener('click', () => {
        // Toggle the visibility of the child comments container
        childComents_container.classList.toggle('hidden');

        // Toggle the button text between "Mostrar mais" and "Mostrar menos"
        if (childComents_container.classList.contains('hidden')) {
            button.textContent = 'Mostrar mais';
        } else {
            button.textContent = 'Mostrar menos';
        }

        if(button.textContent == 'Mostrar menos') {

            childComents_container.classList.remove('hidden');

        }
    });
});

{
const containers = document.querySelectorAll('[id^="read-more-container-"]');
const readMoreBtns = document.querySelectorAll('[id^="read-more-btn-"]');

// Loop through each container
containers.forEach((container, index) => {
    // Get the corresponding button for this container
    const readMoreBtn = readMoreBtns[index];

    // Check if content exceeds max height
    if (container.scrollHeight > 96) { // 96 = 24rem in Tailwind (1rem = 16px)
        readMoreBtn.classList.remove('hidden'); // Show the button
    }

    // Toggle the height of the container when "Read More" is clicked
    readMoreBtn.addEventListener('click', () => {
        container.classList.toggle('max-h-24'); // Toggle max height
        container.classList.toggle('h-full'); // Toggle full height
        readMoreBtn.textContent = container.classList.contains('max-h-24') ? 'Leia Mais..' : 'Menos';
    });
});
}

