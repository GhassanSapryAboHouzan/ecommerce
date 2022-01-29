<div class=" mb-5 pa mt-10">
    <form class="form" action="{{ route('admin.customer_addresses.index') }}" method="get">

        <div class="form-row">
            <div class="form-group col-md-3">
                <input class="form-control" type="text" name="keyword"
                       value="{{ old('keyword', request()->input('keyword')) }}"
                       placeholder="{!! __('common.search_here') !!}">
            </div>

            <div class="form-group col-md-2">
                <select name="status" class="form-control">
                    <option value="">---</option>
                    <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : '' }}>
                        {!! __('common.active') !!}
                    </option>
                    <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : '' }}>
                        {!! __('common.inactive') !!}
                    </option>
                </select>
            </div>


            <div class="form-group col-md-2">
                <select name="sort_by" class="form-control">
                    <option value="">---</option>
                    <option value="id" {{ old('sort_by', request()->input('sort_by')) == 'id' ? 'selected' : '' }}>
                        {!! __('common.id') !!}
                    </option>
                    <option
                        value="name" {{ old('sort_by', request()->input('sort_by')) == 'name' ? 'selected' : '' }}>
                        {!! __('common.name') !!}
                    </option>
                    <option
                        value="created_at" {{ old('sort_by', request()->input('sort_by')) == 'created_at' ? 'selected' : '' }}>
                        {!! __('common.created_at') !!}
                    </option>
                </select>
            </div>


            <div class="form-group col-md-2">
                <select name="order_by" class="form-control">
                    <option value="">---</option>
                    <option
                        value="asc" {{ old('order_by', request()->input('order_by')) == 'asc' ? 'selected' : '' }}>
                        {!! __('common.ascending') !!}
                    </option>
                    <option
                        value="desc" {{ old('order_by', request()->input('order_by')) == 'desc' ? 'selected' : '' }}>
                        {!! __('common.descending') !!}
                    </option>
                </select>
            </div>

            <div class="form-group col-md-2">
                <select name="limit_by" class="form-control">
                    <option value="">---</option>
                    <option
                        value="5" {{ old('limit_by', request()->input('limit_by')) == '5' ? 'selected' : '' }}>5
                    </option>
                    <option
                        value="10" {{ old('limit_by', request()->input('limit_by')) == '10' ? 'selected' : '' }}>10
                    </option>
                    <option
                        value="20" {{ old('limit_by', request()->input('limit_by')) == '20' ? 'selected' : '' }}>20
                    </option>
                    <option
                        value="50" {{ old('limit_by', request()->input('limit_by')) == '50' ? 'selected' : '' }}>50
                    </option>
                    <option
                        value="100" {{ old('limit_by', request()->input('limit_by')) == '100' ? 'selected' : '' }}>
                        100
                    </option>
                </select>
            </div>


            <!--
              <div class="form-group col-md-2"></div>
            -->


            <div class="form-group col-md-1">
                <button type="submit" name="submit" class="btn btn-link">{!! __('common.search') !!}</button>
            </div>

        </div>
    </form>
</div>


