@switch($user->role)
    @case('admin')
        <li><a href="/"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
        <li><a href="/content"><i class="fa fa-hand"></i><span>Konten</span></a></li>
        <li><a href="/account"><i class="fa fa-handcuffs"></i><span>Author</span></a></li>
        @break
    @case('author')
        <li><a href="/"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
        <li><a href="/content"><i class="fa fa-list"></i><span>Konten</span></a></li>
        @break
    @default
@endswitch