<table style="border-collapse:collapse;width:100%;font-family:'Tahoma',Arial,sans-serif;font-size:14px;">
    <thead>
        <tr style="background:#290909;color:#fffdfd;border-bottom:2px solid #888;">
            <th style="padding:8px 5px;border:1px solid #bbb;">#</th>
            <th style="padding:8px 5px;border:1px solid #bbb;">الاسم</th>
            <th style="padding:8px 5px;border:1px solid #bbb;">البريد الإلكتروني</th>
            <th style="padding:8px 5px;border:1px solid #bbb;">عدد المنشورات</th>
            <th style="padding:8px 5px;border:1px solid #bbb;">الحالة</th>
            <th style="padding:8px 5px;border:1px solid #bbb;">تاريخ التسجيل</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $i => $user)
            <tr style="background:{{ $i%2==0 ? '#fff' : '#f9f9f9' }};">
                <td style="padding:8px 5px;border:1px solid #ddd;">{{ $user->id }}</td>
                <td style="padding:8px 5px;border:1px solid #ddd;">{{ $user->name }}</td>
                <td style="padding:8px 5px;border:1px solid #ddd;">{{ $user->email }}</td>
                <td style="padding:8px 5px;border:1px solid #ddd;">{{ $user->posts_count }}</td>
                <td style="padding:8px 5px;border:1px solid #ddd;">
                    <span style="display:inline-block;padding:2px 10px;border-radius:7px;color:#fff;font-weight:bold;background:{{ $user->is_banned ? '#dc3545' : '#28a745' }};">
                        {{ $user->is_banned ? 'محظور' : 'نشط' }}
                    </span>
                </td>
                <td style="padding:8px 5px;border:1px solid #ddd;">{{ $user->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
