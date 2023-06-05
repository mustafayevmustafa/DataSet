<div class="row mt-3 mb-3">
    <div class="col">
        <form action="{{ route('datasets.index') }}" method="get">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" >
                        <option value="">All</option>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="gender">Gender</label>
                    <select class="form-control" name="gender">
                        <option value="">All</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="birthDate">Age</label>
                    <input type="number" class="form-control" name="birthDate"  value="{{ request('birthDate') }}" placeholder="Age">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="min_age">Min Age</label>
                    <input type="number" class="form-control" name="min_age" value="{{ request('min_age') }}" placeholder="Min Age">
                </div>
                <div class="col-md-2 mb-3">
                    <label for="max_age">Max Age</label>
                    <input type="number" class="form-control" name="max_age"  value="{{ request('max_age') }}" placeholder="Max Age">
                </div>
                <div class="col-md-2 mb-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
