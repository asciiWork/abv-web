<div class="row">
    <div class="col-xl-12">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Advance Search
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form id="search-frm">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="form-label">Date</label>
                                    <div class="input-group mb-3">
                                        {!! Form::date('search_start_date', null, ['class' => 'form-control']) !!}
                                        <span class="input-group-text">To</span>
                                        {!! Form::date('search_end_date', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Client Name</label>
                                        {!! Form::text('search_client_name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Client Phone</label>
                                        {!! Form::text('search_client_phone', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Client Company</label>
                                        {!! Form::text('search_company', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Type</label>
                                        {!! Form::text('search_type', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Number</label>
                                        {!! Form::text('search_qn_number', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('admin-invoices.payments') }}" class="btn btn-warning">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />