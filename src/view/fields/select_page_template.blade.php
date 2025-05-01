@include(fieldview('inc.wrapper_start'))

    <label>{{ $field['label'] }}</label>
    <select
    	class="form-control"
        id="select_template"

    	@foreach ($field as $attribute => $value)
            @if (!is_array($value))
    		{{ $attribute }}="{{ $value }}"
            @endif
    	@endforeach
    	>

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif

    	@if (count($field['options']))
    		@foreach ($field['options'] as $key => $value)
    			<option value="{{ $key }}"
					@if (isset($field['value']) && $key==$field['value'])
						 selected
					@endif
    			>{{ $value }}</option>
    		@endforeach
    	@endif
	</select>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
    @include(fieldview('inc.wrapper_end'))
@if ($Amer->checkIfFieldIsFirstOfItsType($field, $fields))
@push('after_scripts')
        <script>
            function redirect_to_new_page_with_template_parameter() {
                var new_template = $("#select_template").val();
                var current_url = "{{ Request::url() }}";

                window.location.href = strip_last_template_parameter(current_url) + '?template=' + new_template;
            }

            function strip_last_template_parameter(url) {
                // if it's a create or edit link with a template parameter
                if (url.indexOf("/create/") > -1 || url.indexOf("/edit/") > -1) {
                    // remove the last parameter of the url
                    var url_array = url.split('/');
                    url_array = url_array.slice(0, -1);
                    var clean_url = url_array.join('/');

                    return clean_url;
                }

                return url;
            }

            jQuery(document).ready(function($) {
                $('#select_template').data('current', $('#select_template').val());

                $("#select_template").change(function(e) {
                    swal({
                        title: "{!! trans('AMER::base.notice') !!}",
                        text: "{!! trans('PAGELANG::Pages.change_template_confirmation') !!}",
                        icon: "warning",
                        buttons: true,
                    }).then((confirmation) => {
                        if (confirmation) {
                            redirect_to_new_page_with_template_parameter();
                        } else {
                            $('#select_template').val($('#select_template').data('current'));
                        }
                    });
                });

            });
        </script>
    @endpush
@endif
