<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
        'files'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    /**
     * Scope untuk filter data
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        // Jika ada parameter filter, apply filter
        collect($filterableColumns)->each(function ($column) use ($query, $request) {
            $request->filled($column) && $query->where($column, $request->input($column));
        });

        return $query;
    }

    /**
     * Scope untuk search data
     */
    public function scopeSearch(Builder $query, $request, array $columns): Builder
    {
        // Jika ada parameter search, apply search
        $request->filled('search') && $query->where(function($q) use ($request, $columns) {
            collect($columns)->each(function ($column) use ($q, $request) {
                $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
            });
        });

        return $query;
    }

    /**
     * Delete a specific file
     */
    // Di Pelanggan.php model
public function deleteFile(string $fileName): void
{
    $this->files = collect($this->files ?? [])
        ->reject(function ($file) use ($fileName) {
            return is_array($file) && isset($file['path']) && $file['path'] === $fileName;
        })
        ->values()
        ->toArray();

    $this->save();

    // Delete physical file
    $filePath = public_path('storage/files/' . $fileName);
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

    /**
     * Get files by type
     */
    public function getFilesByType(string $type): Collection
    {
        return collect($this->files ?? [])
            ->filter(function ($file) use ($type) {
                return $file['type'] === $type;
            });
    }

    /**
     * Check if has files
     */
    public function hasFiles(): bool
    {
        return !empty($this->files) && count($this->files) > 0;
    }

    /**
     * Get files count
     */
    public function getFilesCount(): int
    {
        return count($this->files ?? []);
    }
}
