// Aplica o tema da página (Light/Dark Mode) de acordo com as configurações do navegador
function updateTheme() {
    const colorMode = window.matchMedia("(prefers-color-scheme: dark)").matches ?
        "dark" :
        "light";
    document.querySelector("html").setAttribute("data-bs-theme", colorMode);
}

updateTheme()

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateTheme)
