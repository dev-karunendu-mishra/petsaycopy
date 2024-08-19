<x-form-component
    :fields="$fields"
    :isEditing="$edit"
    actionRoute="{{route('admin.orders.store')}}"
    editRoute="{{ $edit ? route('admin.orders.update', $model->id) : ''}}"
    isSEOEnabled="{{true}}"
    :model="$model"
    updateBtnText="Update Information"
    submitBtnText="Create New Order" />