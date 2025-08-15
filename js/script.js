document.addEventListener("DOMContentLoaded", function() {
    fetch('portfolio.json')
        .then(response => response.json())
        .then(data => {
            const portfolioGrid = document.getElementById('portfolio-grid');
            data.forEach(project => {
                const projectCard = document.createElement('div');
                projectCard.classList.add('service');
                projectCard.innerHTML = `
                    <img src="${project.image}" alt="${project.title}" style="width:100%; border-radius:8px; margin-bottom:10px;">
                    <h4>${project.title}</h4>
                    <p>${project.description}</p>
                    <a href="${project.link}" target="_blank" class="btn">Bekijk project</a>
                `;
                portfolioGrid.appendChild(projectCard);
            });
        })
        .catch(error => console.error('Error loading portfolio:', error));
});


