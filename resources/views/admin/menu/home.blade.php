@extends('layouts.admin')

@section('content')

<div id="home_roles" >
    <div class="ibox-content">
        <a href="{{ url('admin/menu/create')}}" type="button" class="btn btn-primary btn-lg">Add new Menu</a>
        <table class="table">
            <thead>
                <tr>
                    <!-- <th >Id</th> -->
                    <th  data-sort="name" class="sort">Name
                        <span class="name fa fa-sort"></span>
                    </th>
                    <th >Alias</th>
                    <th >Icon</th>
                    <th data-sort="parent_id" class="sort">
                        Parent name
                        <span class="parent_id fa fa-sort"></span>
                    </th>
                    <th >Link</th>
                    <th >Target</th>
                    <th data-sort="published" class="sort">
                        Yes/No
                        <span class="published fa fa-sort"></span>
                    </th>
                    <th >&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr>				
                    {{--<td > {{$menu->id}} </td> --}}
                    <td > {{$menu->name}} </td>
                    <td > {{$menu->alias}} </td>
                    <td > {{$menu->icon}} </td>
                    <td >
                        @if ($menu->parent_id != 0)
                            @php $menu_item = App\Http\Controllers\Admin\MenuController::getMenu($menu->parent_id); @endphp
                            {{$menu_item->name}} 
                        @endif
                    </td>
                    <td > {{$menu->link}} </td>
                    <td > {{$menu->target}} </td>
                    <td > {{$menu->published == 1 ? 'Yes' : 'No'}} </td>
                    <td style="width: 162px;">
                        <a href="{{ url('admin/menu/edit/'. $menu->id) }}" class="btn btn-info">Update</a>
                        <a href="{{ url('admin/menu/delete/' . $menu->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="menu_pagination">{{$menus->links()}}</div>
    </div>
</div>
<form id="sort">
    <input class="sort_by" type="hidden" name="sort_by" value="{{$sort_by}}" />
    <input class="sort_dimen" type="hidden"  name="sort_dimen" value="{{$sort_dimen}}" />

</form>
@endsection