@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>{{ $pageTitle ?? ''}}</h2>
                        </div>
                        <div class="col-md-3">
                            <?php echo isset($button) ? $button : '' ?>
                        </div>
                    </div>
                </div>
                <?php echo $dataTable->table(['class' => 'table'],true) ?>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
	@parent
	<?php echo $dataTable->scripts() ?>

@endsection
