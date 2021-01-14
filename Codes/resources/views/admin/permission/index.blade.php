@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>{{ $pageTitle }}</h2>
                        </div>
                        <div class="col-md-6">
                            <a href="#" data-toggle="form" data--href="{{ route('permission.add',['type'=>'role']) }}"
                               class="float-right ml-10 btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i> {{ _t(__('message.roles.action', ['Action' => 'Add'])) }}
                            </a>
                            {{--
                            <a href="#" data-toggle="form" data--href="{{ route('permission.add',['type'=>'permission']) }}"
                               class="float-right btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i> {{ _t(__('message.permissions.action',  ['Action' => 'Add'])) }}
                            </a>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            {{ Form::open(['route' => 'permission.store','method' => 'post']) }}
                <div class="accordion cursor" id="permissionList">
                @foreach($permission as $p)
                    <div class="card">
                        <div class="card-header collapsed btn text-left" id="heading_{{$p->id}}" data-toggle="collapse" data-target="#pr_{{$p->id}}" aria-expanded="false" aria-controls="pr_{{$p->id}}">
                            <h5 class="mb-0"> <i class="fa fa-plus mr-10"></i> {{ ucwords($p->name) }} Module</h5>
                        </div>
                        <div id="pr_{{$p->id}}" class="collapse bg_light_gray" aria-labelledby="heading_{{$p->id}}"
                             data-parent="#permissionList">
                            <div class="card-body pall-10 text-center table-responsive">
                                <table class="table table-bordered bg_white">
                                    <tr>
                                        @foreach($roles as $role)
                                            <td><b>{{ ucwords($role->name) }}</b></td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach($roles as $role)
                                            <td>
                                                <input class="checkbox no-wh" id="permission-{{$role->id}}-{{$p->id}}" type="checkbox" name="permission[{{$p->name}}][]" value='{{$role->name}}' {{ (checkRolePermission($role,$p->name)) ? 'checked' : '' }} 
                                                @if($role->guard_name=='admin') disabled checked @endif >
                                            </td>
                                        @endforeach
                                    </tr>
                                </table>
                                <input type="submit" name="Save" value="Save" class="btn btn-md btn-primary float-right mall-10">
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('body_bottom')
<script>
    (function($) {

        "use strict";

        $(document).ready(function(){
            $(document).on('click','#permissionList .card-header',function(){
                $('#permissionList .card-header i').removeClass('fa-plus').removeClass('fa-minus').addClass('fa-plus');
                $(this).find('i').removeClass('fa-plus').addClass('fa-minus');
            });
        });
        
    })(jQuery);

</script>
@endsection
