
<div class="w-60 h-full">
    
    <x-form.get :action="route('frontend.product.search')">
        <div class="input-group">
            <button type="submit" class="input-group-text" id="basic-addon1">
                <i class="fa-solid fa-search"></i>
            </button>
            <input value="{{ request()->input('searchTerm') }}" type="text" name="searchTerm" class="form-control border-[#dee2e6]" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
        </div>
    </x-form.get>

</div>