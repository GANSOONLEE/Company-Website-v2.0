@props(['category'])

@inject('models', 'App\Models\CarModel')

<div id="sidebar-background" class="background bg-black opacity-75 w-full h-full fixed top-0 left-0 z-1" hidden></div>

<div id="sidebar" class="z-99 bg-blue-500 fixed -left-100 top-0 h-full w-60 overflow-y-auto no-scrollbar transition duration-100 ease-in-out px-4 py-17">
    
    <h3 class="text-white text-xl flex justify-content-start column-gap-3 mb-3"><i class="fa-solid fa-filter"></i>Filter</h3>

    @foreach ($models::all() as $model) 
        <x-frontend.sidebar-item :href="route('frontend.product.query', ['category' => $category,'model'=>$model->name])" :label="$model->name"/>
    @endforeach

</div>

<script>
let sidebarButton = document.querySelector('#sidebar-button');
let sidebarBackground = document.querySelector('#sidebar-background');
let sidebar = document.querySelector('#sidebar');
let body = document.body;

sidebarButton.addEventListener('click', e => {
    sidebarBackground.classList.add('z-9');
    sidebarBackground.classList.remove('z-1');
    sidebarBackground.hidden = false;

    sidebar.classList.add('left-0');
    sidebar.classList.remove('-left-100');

    body.style.overflowY = 'hidden';
});

sidebarBackground.addEventListener('click', e => {

    // close sidebar
    e.target.classList.remove('z-9');
    e.target.classList.add('z-1');
    e.target.hidden = true;

    sidebar.classList.remove('left-0');
    sidebar.classList.add('-left-100');

    body.style.overflowY = 'auto';

});
</script>