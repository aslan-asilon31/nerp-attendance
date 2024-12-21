<?php

namespace App\Livewire\Pages\Employees\Components;

use App\Helpers\Table\Traits\WithTable;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class EmployeeTable extends PowerGridComponent
{
  use WithExport;
  use WithTable;

  public function setUp(): array
  {
    $this->showCheckBox();

    return [
      Exportable::make('export')
        ->striped()
        ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
      // Header::make()
      //   ->showSearchInput(),
      Footer::make()
        ->showPerPage(25, [10, 25, 50, 100])
        ->showRecordCount(),
    ];
  }

  public function datasource(): Builder
  {
    return Employee::query()
      ->with('position');
  }

  public function relationSearch(): array
  {
    return [
      'position' => [
        'name',
      ],
    ];
  }

  public function fields(): PowerGridFields
  {
    return PowerGrid::fields()

      ->add('no', fn($record) => $record->id)
      ->add('id')
      ->add('name')
      // ->add('position_id')
      ->add('position_name', fn($record) => $record->position->name)
      // ->add('is_activated')
      ->add('is_activated', fn($record) => $record->is_activated ? 'Aktif' : 'Non-aktif')
      // ->add('created_at')
    ;
  }

  public function columns(): array
  {
    return [


      Column::make('No', 'no')
        ->index(),

      Column::make('ID', 'id')
        ->sortable(),
      // ->searchable(),

      Column::make('Nama', 'name')
        ->sortable(),

      // Column::make('Position ID', 'position_id')
      //   ->sortable(),

      Column::make('Posisi', 'position_name'),
      // ->sortable(),
      // ->searchable(),

      Column::make('No. Telp / HP', 'phone')
        ->sortable(),

      Column::make('Email', 'email')
        ->sortable(),

      // Column::add()
      //   ->title('Employee Name')
      //   ->field('name')
      //   ->searchable()
      //   ->contentClasses('!whitespace-normal')
      //   ->placeholder('placeholder')
      //   ->sortable(),

      // Column::make('Created at', 'created_at_formatted', 'created_at')
      //   ->sortable(),

      Column::make('Tgl. Dibuat', 'created_at')
        ->sortable(),

      Column::make('Tgl. Diupdate', 'updated_at')
        ->sortable(),

      // Column::make('Is Activated', 'is_activated')
      //   ->sortable(),

      Column::make('Aktif', 'is_activated')
        ->bodyAttribute('text-center'),
      // ->toggleable(hasPermission: true, trueLabel: 'yes', falseLabel: 'no')
      // ->sortable()

      Column::action('Aksi')
        ->visibleInExport(false),

    ];
  }

  public function filters(): array
  {
    return [
      Filter::inputText('id', 'id')->placeholder('ID'),
      // Filter::inputText('name', 'name')->placeholder('Name'),
      Filter::dynamic('name', 'id')
        ->component('select')
        ->attributes([
          'async-data'      => 'https://umedalife-private.test/api/v1/select/employees',
          'option-label'    => 'name',
          'multiselect'     => false,
          'option-value'    => 'id',
          'wire:model.live' => 'filters.select.id',
          'placeholder'     => 'Nama',
        ]),

      // Filter::inputText('position_name', 'position_name')->placeholder('Position'),
      // Filter::select('position_name', 'position_id') // letak filter di header position_name, yang di cari berdasarkan position_id
      //   ->dataSource(Position::all())
      //   ->optionLabel('name')
      //   ->optionValue('id'),

      Filter::dynamic('position_name', 'position_id')
        ->component('select')
        ->attributes([
          // 'async-data'      => 'https://umedalife-private.test/api/v1/select/positions',
          'multiselect'     => false,
          'option-label'    => 'name',
          'option-value'    => 'id',
          'wire:model.live' => 'filters.select.position_id',
          'placeholder'     => 'Posisi',
          'options' => Position::all(),
          // 'options' => Employee::all(),
          // 'options' => [
          //   ['id' => 'admin', 'name' => 'Admin'],
          //   ['id' => 'developer', 'name' => 'Developer'],
          // ]
        ]),

      Filter::inputText('phone', 'phone')->placeholder('Phone'),
      Filter::inputText('email', 'email')->placeholder('Email'),
      Filter::datetimepicker('created_at', 'created_at')
        ->params(['timezone' => 'Asia/Jakarta',]),
      Filter::datetimepicker('updated_at', 'updated_at')
        ->params(['timezone' => 'Asia/Jakarta',]),

      Filter::boolean('is_activated', 'is_activated')
        ->label('Aktif', 'Non-aktif'),
    ];
  }



  public function actions(Employee $row): array
  {
    return [
      // Button::add('edit')
      //   ->slot('Edit')
      //   ->id()
      //   ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
      //   ->dispatch('edit', ['rowId' => $row->id])



      Button::add('show')
        ->slot('Lihat')
        ->class($this->showButtonClass)
        ->dispatch('clickToShow', ['id' => $row?->id, 'name' => $row?->name]),

      Button::add('edit')
        ->slot('Edit')
        ->class($this->editButtonClass)
        ->dispatch('clickToEdit', ['id' => $row?->id, 'name' => $row?->name]),

      Button::add('print')
        ->slot('Cetak')
        ->class($this->printButtonClass)
        ->dispatch('clickToPrint', ['id' => $row?->id, 'name' => $row?->name]),
      // Button::add('delete')
      //   ->slot('Hapus')
      //   ->class($this->deleteButtonClass)
      //   ->dispatch('clickToDelete', ['id' => $row?->id, 'name' => $row?->name]),
    ];
  }

  #[\Livewire\Attributes\On('clickToPrint')]
  public function clickToPrint(string $id, string $name): void
  {
    $this->js('alert(\'Print  ' . $id . '\')');
  }

  #[\Livewire\Attributes\On('clickToShow')]
  public function clickToShow(string $id, string $name): void
  {
    $this->js('alert(\'Show ' . $id . '\')');
  }


  #[\Livewire\Attributes\On('clickToEdit')]
  public function clickToEdit(string $id, string $name): void
  {
    $this->js('alert(\'Edit ' . $id . '\')');
  }

  #[\Livewire\Attributes\On('clickToDelete')]
  public function clickToDelete(string $id, string $name): void
  {
    $this->js('alert(\'Delete ' . $id . '\')');
  }

  /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
