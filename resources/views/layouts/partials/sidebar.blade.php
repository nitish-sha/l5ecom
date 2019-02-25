<h2>Categories</h2>
<ul>
	@forelse(App\Category::where('status', 'Approved')->get() as $category )
	<li>{{ $category->title }}</li>
	@empty
	<li>No Category Found</li>
	@endforelse
	
</ul>