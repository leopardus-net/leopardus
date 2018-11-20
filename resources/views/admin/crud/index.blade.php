@extends('layouts.app')

@section('title')
    {{ trans('crud.title') }}
@stop

@section('styles')
    <style>
        .form-delete {
            width: auto;
            float: left;
            margin-left: 10px;
        }
    </style>
@stop

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('crud.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('permissions.new') }}</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <div class="card">
        <div class="card-body">
    		<h4 class="card-title">CRUD Manager</h4>
    		<h6 class="card-subtitle">Just add <code>form-control-line</code> class to form</h6>
            <form action="#" class="form-horizontal form-bordered" style="border-top: 1px solid rgba(120, 130, 140, 0.13);padding-top: 20px;">
                <div class="form-body">
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">First Name</label>
                        <div class="col-md-9">
                            <input placeholder="small" class="form-control" type="text">
                            <small class="form-control-feedback"> This is inline help </small> </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Last Name</label>
                        <div class="col-md-9">
                            <input placeholder="medium" class="form-control" type="text">
                            <small class="form-control-feedback"> This is inline help </small> </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Gender</label>
                        <div class="col-md-9">
                            <select class="form-control custom-select">
                                <option value="">Male</option>
                                <option value="">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Date of Birth</label>
                        <div class="col-md-9">
                            <input class="form-control" placeholder="dd/mm/yyyy" type="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Category</label>
                        <div class="col-md-9">
                            <select class="form-control custom-select">
                                <option value="Category 1">Category 1</option>
                                <option value="Category 2">Category 2</option>
                                <option value="Category 3">Category 5</option>
                                <option value="Category 4">Category 4</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Multi-Value Select</label>
                        <div class="col-md-9">
                            <select class="form-control" multiple="">
                                <optgroup label="NFC EAST">
                                    <option>Dallas Cowboys</option>
                                    <option>New York Giants</option>
                                    <option>Philadelphia Eagles</option>
                                    <option>Washington Redskins</option>
                                </optgroup>
                                <optgroup label="NFC NORTH">
                                    <option>Chicago Bears</option>
                                    <option>Detroit Lions</option>
                                    <option>Green Bay Packers</option>
                                    <option>Minnesota Vikings</option>
                                </optgroup>
                                <optgroup label="NFC SOUTH">
                                    <option>Atlanta Falcons</option>
                                    <option>Carolina Panthers</option>
                                    <option>New Orleans Saints</option>
                                    <option>Tampa Bay Buccaneers</option>
                                </optgroup>
                                <optgroup label="NFC WEST">
                                    <option>Arizona Cardinals</option>
                                    <option>St. Louis Rams</option>
                                    <option>San Francisco 49ers</option>
                                    <option>Seattle Seahawks</option>
                                </optgroup>
                                <optgroup label="AFC EAST">
                                    <option>Buffalo Bills</option>
                                    <option>Miami Dolphins</option>
                                    <option>New England Patriots</option>
                                    <option>New York Jets</option>
                                </optgroup>
                                <optgroup label="AFC NORTH">
                                    <option>Baltimore Ravens</option>
                                    <option>Cincinnati Bengals</option>
                                    <option>Cleveland Browns</option>
                                    <option>Pittsburgh Steelers</option>
                                </optgroup>
                                <optgroup label="AFC SOUTH">
                                    <option>Houston Texans</option>
                                    <option>Indianapolis Colts</option>
                                    <option>Jacksonville Jaguars</option>
                                    <option>Tennessee Titans</option>
                                </optgroup>
                                <optgroup label="AFC WEST">
                                    <option>Denver Broncos</option>
                                    <option>Kansas City Chiefs</option>
                                    <option>Oakland Raiders</option>
                                    <option>San Diego Chargers</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Membership</label>
                        <div class="col-md-9">
                            <div class="m-b-10">
                                <label class="custom-control custom-radio">
                                    <input id="radio5" name="radio" class="custom-control-input" type="radio">
                                    <span class="custom-control-label">Free</span>
                                </label>
                                <label class="custom-control custom-radio">
                                    <input id="radio6" name="radio" class="custom-control-input" type="radio">
                                    <span class="custom-control-label">Paid</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Street</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">City</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">State</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Post Code</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text">
                        </div>
                    </div>
                    <div class="form-group row last">
                        <label class="control-label text-right col-md-3">Country</label>
                        <div class="col-md-9">
                            <select class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="offset-sm-3 col-md-9">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">Generator</div>
        <div class="card-body">

            <form class="form-horizontal" method="post" action="{{ url('/admin/crud-manager/generator') }}">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="crud_name" class="col-md-4 col-form-label text-right">Crud Name:</label>
                    <div class="col-md-6">
                        <input type="text" name="crud_name" class="form-control" id="crud_name" placeholder="Posts" required="true">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="controller_namespace" class="col-md-4 col-form-label text-right">Controller Namespace:</label>
                    <div class="col-md-6">
                        <input type="text" name="controller_namespace" class="form-control" id="controller_namespace" placeholder="Admin">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="route_group" class="col-md-4 col-form-label text-right">Route Group Prefix:</label>
                    <div class="col-md-6">
                        <input type="text" name="route_group" class="form-control" id="route_group" placeholder="admin">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="view_path" class="col-md-4 col-form-label text-right">View Path:</label>
                    <div class="col-md-6">
                        <input type="text" name="view_path" class="form-control" id="view_path" placeholder="admin">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="route" class="col-md-4 col-form-label text-right">Want to add route?</label>
                    <div class="col-md-6">
                        <select name="route" class="form-control" id="route">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="relationships" class="col-md-4 col-form-label text-right">Relationships</label>
                    <div class="col-md-6">
                        <input type="text" name="relationships" class="form-control" id="relationships" placeholder="comments#hasMany#App\Comment">
                        <p class="help-block">method#relationType#Model</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="form_helper" class="col-md-4 col-form-label text-right">Form Helper</label>
                    <div class="col-md-6">
                        <input type="text" name="form_helper" class="form-control" id="form_helper" placeholder="laravelcollective" value="laravelcollective">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soft_deletes" class="col-md-4 col-form-label text-right">Want to use soft deletes?</label>
                    <div class="col-md-6">
                        <select name="soft_deletes" class="form-control" id="soft_deletes">
                            <option value="no">No</option>
                            <option value="yes">Yes</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group table-fields">
                    <h4 class="text-center">Table Fields:</h4><br>
                    <div class="entry col-md-10 offset-md-2 form-inline">
                        <input class="form-control" name="fields[]" type="text" placeholder="field_name" required="true">
                        <select name="fields_type[]" class="form-control">
                            <option value="string">string</option>
                            <option value="char">char</option>
                            <option value="varchar">varchar</option>
                            <option value="password">password</option>
                            <option value="email">email</option>
                            <option value="date">date</option>
                            <option value="datetime">datetime</option>
                            <option value="time">time</option>
                            <option value="timestamp">timestamp</option>
                            <option value="text">text</option>
                            <option value="mediumtext">mediumtext</option>
                            <option value="longtext">longtext</option>
                            <option value="json">json</option>
                            <option value="jsonb">jsonb</option>
                            <option value="binary">binary</option>
                            <option value="number">number</option>
                            <option value="integer">integer</option>
                            <option value="bigint">bigint</option>
                            <option value="mediumint">mediumint</option>
                            <option value="tinyint">tinyint</option>
                            <option value="smallint">smallint</option>
                            <option value="boolean">boolean</option>
                            <option value="decimal">decimal</option>
                            <option value="double">double</option>
                            <option value="float">float</option>
                        </select>

                        <label>Required</label>
                        <select name="fields_required[]" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>

                        <button class="btn btn-success btn-add inline btn-sm" type="button">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>
                <p class="help text-center">It will automatically assume form fields based on the migration field type.</p>
                <br>
                <div class="form-group row">
                    <div class="offset-md-4 col-md-4">
                        <button type="submit" class="btn btn-primary" name="generate">Generate</button>
                    </div>
                </div>
            </form>

        </div>
	</div>
    
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(tableFields);
                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="fa fa-minus"></span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents('.entry:first').remove();
                e.preventDefault();
                return false;
            });
        });
    </script>
@stop