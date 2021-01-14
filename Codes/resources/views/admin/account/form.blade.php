<div class="row">

    <div class="col-md-4">
        <img
            src="{{getSingleMedia(auth()->user(),'profile_image')}}"
            alt="Raised circle image"
            class="img-fluid d-block mx-auto rounded-circle circle-image shadow-lg profile_image"
            style="width: 150px;height: 150px;"
        >

        <span class="d-block font-weight-bold mt-3 text-center cursor-pointer" data--toggle="upload_modal" data-target-input=".upload_profile">{{ _t(__('message.change_photo'))}}</span>
        <input type="file" name="profile_image" class="upload_profile d-none" data--toggle="values" data--target=".profile_image" data--modal="modal">
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="control-label">{{ _t(__('message.name')) }} <span class="text-danger">*</span></label>
                    {{ Form::text('name',old('name'),['class' => 'form-control','id' => 'name','required']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="control-label">{{ _t(__('message.email')) }} <span class="text-danger">*</span></label>
                    {{ Form::email('email',old('email'),['class' => 'form-control','id' => 'email','required']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password" class="control-label">{{ _t(__('message.password')) }} <span class="text-danger">*</span></label>
                    {{ Form::password('password', ['class' => 'form-control','id' => 'password']) }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="password-confirm" class="control-label">{{ _t(__('message.confirm_password')) }} <span class="text-danger">*</span></label>
                    {{ Form::password('password_confirmation', ['class' => 'form-control','id' => 'password-confirm']) }}
                </div>
            </div>
        </div>
    </div>
</div>

