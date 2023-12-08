
<div class="container">
    <div class="content">

        <section class="input-area active" data-page="1">
        
            <div class="">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control" autocomplete="username" name="email" id="email" placeholder="Email" required>
            </div>
        
            <div class="flex-column">
                <label for="password" class="form-label required">Password</label>
                <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Password" required>
                <a href="{{ route('auth.forget-password') }}" class="forget-password">Forget Password ?</a>
            </div>
                
        </section>


    </div>
    <div class="buttons mt-3">
        <button type="submit" id="submit-button" class="btn btn-success">Submit</button>
    </div>
</div>
