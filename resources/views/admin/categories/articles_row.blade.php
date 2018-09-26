<tr data-index="{{ $index }}">
    <td>{!! Form::text('articles['.$index.'][titre]', old('articles['.$index.'][titre]', isset($field) ? $field->titre: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>