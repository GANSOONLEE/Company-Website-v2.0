
/**
 * Switch theme color 切換主題顔色
 */

export function initThemeSwitch() {

    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    const themeToggleBtn = document.getElementById('theme-toggle');

    if(!themeToggleDarkIcon){
        return false;
    }

    // Change the icons inside the button based on previous settings
    const isDarkTheme = 
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

    isDarkTheme ?
        themeToggleLightIcon.classList.remove('hidden') :
        themeToggleDarkIcon.classList.remove('hidden') ;

    themeToggleBtn.addEventListener('click', e => {

        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

        // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });

    const isDarkThemeInit =
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

    if (isDarkTheme) {
        document.documentElement.classList.add('dark');
    }

    $(document).ready(function($){

        $('[aria-controls="dropdown"]').click(function(event){
            event.preventDefault();

            $(this).toggleClass('active');
            $(this).siblings('ul').slideToggle();

            $(this).parent().siblings().find('[aria-controls="dropdown"]').removeClass('active');
            $(this).parent().siblings().find('ul').slideUp();
        });

    });
}