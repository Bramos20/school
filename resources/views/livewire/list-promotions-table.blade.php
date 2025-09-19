<div class="card">
    <div class="card-header">
        <h4 class="card-title">Promotion list</h4>
    </div>
    <div class="card-body">
        <livewire:datatable :model="App\Models\Promotion::Class" :filters="[['name' => 'where' , 'arguments' => ['academic_year_id', $academicYear->id]], ['name' => 'with' , 'arguments' => ['oldClass','newClass', 'oldSection', 'newSection']]]" :columns="[
                ['property' => 'name', 'name' => 'Old Grade' ,'relation' => 'oldClass'] ,
                ['property' => 'name', 'name' => 'Old Stream' ,'relation' => 'oldSection'] ,
                ['property' => 'name', 'name' => 'New Grade' ,'relation' => 'newClass'] ,
                ['property' => 'name', 'name' => 'New Stream' ,'relation' => 'newSection'] ,
                ['method' => 'count', 'name' => 'New Stream' ,'relation' => 'students'] ,
                ['type' => 'dropdown', 'name' => 'actions','links' => [
                    ['href' => 'students.promotions.show', 'text' => 'View Promoted Students', 'icon' => 'fas fa-eye',],
                ]],
                ['type' => 'delete', 'name' => 'Delete', 'action' => 'students.promotions.reset',]
            ]"/>
    </div>
</div>
