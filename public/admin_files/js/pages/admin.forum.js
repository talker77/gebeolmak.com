$('#tableForum').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/tables/forums',
        data : {
            status : getUrlParameter('status')
        }
    },
    "language": {
        "url": "/admin_files/plugins/jquery-datatable/language-tr.json"
    },
    columns: [
        {data: 'id', name: 'id', title: 'ID'},
        {data: 'title', name: 'title', title: 'Başlık'},
        {
            data: 'image', name: 'image', title: 'Görsel',
            render: function (data, type, row) {
                return data
                    ? `<a href="/storage/blogs/${row['image']}"><i class="fa fa-photo"></i></a>`
                    : ''
            },
        },
        {
            data: 'category_id', name: 'category_id', title: 'Kategori',
            render: function (data, type, row) {
                return data
                    ? `<a href="/admin/category/${data}">${row['category']['title']}</a>`
                    : data
            },
        },
        {
            data: 'sub_category_id', name: 'sub_category_id', title: 'Alt Kategori',
            render: function (data, type, row) {
                return data
                    ? `<a href="/admin/category/${data}">${row['sub_category']['title']}</a>`
                    : data
            },
        },
        {
            data: 'status', name: 'status', title: 'Durum',
            render: function (data, type, row) {
                return row['status_label']
            },
        },
        {
            data: 'writer_id', name: 'writer_id', title: 'Oluşturan', visible: window.IS_ADMIN,
            render: function (data, type, row) {
                return row['writer']
                    ? `<a href="/admin/user/edit/${row['writer_id']}">${row['writer']['full_name']}</a>`
                    : '-'
            }
        },
        {
            data: 'manager_id', name: 'manager_id', title: 'Moderatör', visible: window.IS_ADMIN,
            render: function (data, type, row) {
                return row['manager']
                    ? `<a href="/admin/user/edit/${row['manager_id']}">${row['manager']['full_name']}</a>`
                    : '-'
            }
        },
        {
            data: 'updated_at', name: 'updated_at', title: 'Güncelleme',
            render: function (data, type, row) {
                return createdAt(data)
            }
        },
        {
            data: 'created_at', name: 'created_at', title: 'Oluşturma',
            render: function (data, type, row) {
                return createdAt(data)
            }
        },
        {
            data: 'id', name: 'id', orderable: false,
            render: function (data) {
                return `<a href='/admin/forum/edit/${data}'><i class='fa fa-edit'></i></a> &nbsp;` +
               ( window.IS_ADMIN
                    ? `<a href="#" class="delete-item" data-id="${data}"><i class='fa fa-trash text-danger'></i></a>`
                    : '')
            }
        }
    ],
    order: [0, 'desc'],
    pageLength: 10
});


/**
 *  delete for blog
 */
$('#tableBlog').on('click', '.delete-item', function () {
    if (confirm('Silmek istediğine emin misin ? ')) {
        // $(this).parent().parent().remove()
        const id = $(this).data('id')
        const self = this;
        console.log(id);
        $.ajax({
            url: `/admin/forum/${id}`,
            dataType: 'json',
            method: 'DELETE',
            success: function (data) {
                $(self).parent().parent().css('background-color', 'red')
                    .fadeOut(600, function () {
                        this.remove();
                    });
            },
            error: function (xhr, error) {
                console.log(xhr)
                errorMessage(xhr)
                console.log(error)
            }
        })
    }
});
