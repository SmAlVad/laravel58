<div class="row justify-content-center mb-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>

@if($item->exists)
    <div class="row justify-content-center mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    ID:&nbsp;{{ $item->id }}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Создано</label>
                        <input type="text" value="{{ $item->created_at }}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="title">Изменено</label>
                        <input type="text" value="{{ $item->updated_at }}" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="title">Опубликовано</label>
                        <input type="text" value="{{ $item->published_at }}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
