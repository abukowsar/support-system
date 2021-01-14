<div class="row">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="full_name" class="col-md-4 form-control-label">{{ _t(__('message.full_name'))}} <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'full_name', 'data--change' => 'label', 'data--target' => '.user_name', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 form-control-label">{{ _t(__('message.email'))}}<span class="text-danger">*</span></label>
            <div class="col-sm-8">
                {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email','data--change' => 'label', 'data--target' => '.email', 'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>
        </div>

        @if (!isset($user->id) || $user->id == null)
            <div class="form-group row">
                <label for="password" class="col-md-4 form-control-label">{{ _t(__('message.password'))}}<span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required']) }}
                    <small class="help-block with-errors text-danger"></small>
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-md-4 form-control-label">{{ _t(__('message.confirm_password'))}}<span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    {{ Form::password('password_confirmation', [
                        'class' => 'form-control',
                        'id' => 'password_confirmation',
                        'required',
                        'data-match' => '#password',
                        'data-match-error' => 'Password does not match'
                    ]) }}
                    <small class="help-block with-errors text-danger"></small>
                </div>
            </div>
        @endif

        <div class="form-group row">
            <label for="gender" class="col-md-4 form-control-label">{{ _t(__('message.gender')) }} <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <div for="gender" class="custom-control custom-radio d-inline-block mr-2">
                    {{ Form::radio('userProfile[gender]', 'male', old('gender') ?? 'male', ['class' => 'custom-control-input', 'id' => 'male']) }}
                    <label class="custom-control-label" for="male">{{ _t(__('message.male'))}}</label>
                </div>
                <div class="custom-control custom-radio d-inline-block ">
                    {{ Form::radio('userProfile[gender]', 'female', old('gender'), ['class' => 'custom-control-input', 'id' => 'female']) }}
                    <label class="custom-control-label" for="female">{{ _t(__('message.female')) }}</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="dob" class="col-md-4 form-control-label">{{ _t(__('message.DOB'))}}<span class="text-danger">*</span></label>
            <div class="col-sm-8">
                {{ Form::text('userProfile[dob]', old('dob'), ['class' => 'form-control datepicker', 'id' => 'dob' ,'required']) }}
                <small class="help-block with-errors text-danger"></small>
            </div>
        </div>

        <div class="form-group row">
            <label for="address" class="col-md-4 form-control-label">{{ _t(__('message.address'))}}</label>
            <div class="col-sm-8">
                {{ Form::textarea('userProfile[address]', old('address'), ['class' => 'form-control', 'id' => 'address','data--change' => 'label', 'data--target' => '.address', 'rows' => 4]) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="city" class="col-md-4 form-control-label">{{ _t(__('message.city'))}} </label>
            <div class="col-sm-8">
                {{ Form::text('userProfile[city]', old('city'), ['class' => 'form-control', 'id' => 'city']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="state" class="col-md-4 form-control-label">{{ _t(__('message.state'))}} </label>
            <div class="col-sm-8">
                {{ Form::text('userProfile[state]', old('state'), ['class' => 'form-control', 'id' => 'state']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="country" class="col-md-4 form-control-label">{{ _t(__('message.country'))}} </label>
            <div class="col-sm-8">
                {{ Form::text('userProfile[country]', old('country'), ['class' => 'form-control', 'id' => 'country']) }}
            </div>
        </div>

        <div class="form-group row">
            <label for="pincode" class="col-md-4 form-control-label">{{ _t(__('message.pincode'))}}</label>
            <div class="col-sm-8">
                {{ Form::number('userProfile[pincode]', old('pincode'), ['class' => 'form-control', 'id' => 'pincode','step' => 'any']) }}
            </div>
        </div>
    </div>

    <div class="col-md-4 offset-md-1">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @php $image = isset($profileImage) && $profileImage != null ? $profileImage : asset('assets/img/profile-image.png');  @endphp
                        <img
                            src="{{ $image }}"
                            alt="Raised circle image"
                            class="img-fluid d-block mx-auto rounded-circle circle-image shadow-lg profile_image"
                            style="width: 150px;height: 150px;"
                        >

                        <span class="d-block font-weight-bold mt-3 text-center cursor-pointer" data--toggle="upload_modal" data-target-input=".upload_profile">{{ _t(__('message.change_photo'))}}</span>
                        <input type="file" name="profile_image" class="upload_profile d-none" data--toggle="values" data--target=".profile_image" data--modal="modal">
                    </div>
                </div>
                <hr class="mtb-20">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center">
                            <span>{{ _t(__('message.name'))}} : </span>
                            <span class="user_name">
                                <?php echo  old('name') ? old('name') : (isset($user) ? getFiltedInputValue($user, 'name') : getFiltedInputValue(1)) ?>
                            </span>
                        </h3>
                        <h4 class="text-center">
                            <span>{{ _t(__('message.email'))}} : </span>
                            <span class="email">
                                <?php echo old('email') ? old('email') : (isset($user) ? getFiltedInputValue($user, 'email') : getFiltedInputValue(1)) ?>
                            </span>
                        </h4>
                        <h5 class="text-center">
                            <span>{{ _t(__('message.address'))}} : </span>
                            <span class="address">
                                <?php echo old('address') ? old('address') : (isset($user->userProfile) ? getFiltedInputValue($user->userProfile, 'address') : getFiltedInputValue(1)) ?>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
