
<div class="container">
    <div class="steps">
        <span class="circle active">1</span>
        <span class="circle">2</span>
        <div class="progress-bar">
            <span class="indicator"></span>
        </div>
    </div>
    <div class="content">

        <section class="input-area active" data-page="1">

            <div class="mb-3">
                <label for="name" class="form-label required">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
            </div>
            
            <div class="flex-row group-column">
                <div class="mb-3 flex-column col">
                    <label for="contact_phone" class="form-label required">Contact Phone</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+60</span>
                        <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Contact Phone" required>
                    </div>
                </div>
                
                <div class="mb-3 flex-column col" style="display: none">
                    <label for="whatsapp_phone" class="form-label required">Whatsapp Phone</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+60</span>
                        <input type="text" class="form-control" name="whatsapp_phone" id="whatsapp_phone" placeholder="Whatsapp Phone" required>
                    </div>
                </div>
            </div>

            <div class="flex-row mb-3">
                <input type="checkbox" name="" id="same-phone-number">
                <label for="same-phone-number">My contact phone and whatsapp phone aren't same.</label>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label required">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            </div>
        
            <div class="flex-row group-column">
                <div class="mb-3 flex-column">
                    <label for="password" class="form-label required">Password</label>
                    <input autocomplete="new-passowrd" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
                
                <div class="mb-3 flex-column">
                    <label for="confirm_password" class="form-label required">Confirm Password</label>
                    <input autocomplete="new-passowrd" type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>
            </div>
            
        </section>

        <section class="input-area" data-page="2">

            <div class="flex-row group-column">
                <div class="mb-3">
                    <label for="birthday" class="form-label required">Birthday</label>
                    <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Birthday" required>
                </div>
            
                <div class="mb-3">
                    <label for="address" class="form-label required">Address</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="profession" class="form-label required">Profession</label>
                <input type="text" class="form-control" name="profession" id="profession" placeholder="Profession" required>
            </div>
        
            <div class="mb-3">
                <label for="shop_name" class="form-label required">Shop Name</label>
                <input type="text" class="form-control" name="shop_name" id="shop_name" placeholder="Shop Name" required>
            </div>
        
        </section>

    </div>
    <div class="buttons">
        <button type="button" id="prev" class="btn btn-primary" disabled>Prev</button>
        <button type="button" id="next" class="btn btn-primary" >Next</button>
        <button type="submit" id="submit-button" class="btn btn-success" style="display: none;">Submit</button>
    </div>
</div>



