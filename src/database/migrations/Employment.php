<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->setupPlain();
        $this->setupUncompleted();
    }
    public function training(){
        Schema::create('Employment_training', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UID')->constrained(table: 'Employers');
            $table->char('Stage',2);
            $table->jsonb('Files');
            $table->dateTime('TrainningTimeStart', $precision = 0)->nullable();
            $table->dateTime('TrainningTimeEnd', $precision = 0)->nullable();
            $table->string('TrainningLink')->nullable();
            $table->string('Trainer')->nullable();
            $table->dateTime('Test', $precision = 0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function setupPlain(){
        Schema::create('Employment_ApplyLog', function (Blueprint $table) {
            $table->id();
            $table->jsonb('userData');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Ama', function (Blueprint $table) {
            $table->id();
            $table->string('Text')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Army', function (Blueprint $table) {
            $table->id();
            $table->string('Text')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Drivers', function (Blueprint $table) {
            $table->id();
            $table->string('Text')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Father')->nullable();
            $table->string('Text');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_IncludedFiles', function (Blueprint $table) {
            $table->id();
            $table->Text('FileName');
            $table->enum('checked',[0,1,2])->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Instructions', function (Blueprint $table) {
            $table->id();
            $table->longText('Text');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_MaritalStatus', function (Blueprint $table) {
            $table->id();
            $table->string('Text');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_LagnaPersons', function (Blueprint $table) {
            $table->id();
            $table->enum('Position',[1,2])->default(2);
            $table->string('Name');
            $table->string('Mon');
            $table->longText('Signs')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_DinamicPages', function (Blueprint $table) {
            $table->id();
            $table->string('Text');
            $table->string('Control');
            $table->string('Function');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_StaticPages', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->longText('Content')->nullable();
            $table->Text('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Stages', function (Blueprint $table) {
            $table->id();
            $table->string('Text');
            $table->integer('Days')->nullable();
            $table->string('Page')->nullable();
            $table->enum('Front',[0,1])->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Qualifications', function (Blueprint $table) {
            $table->id();
            $table->enum('Type',['Public','Private'])->default('Public');
            $table->longText('Text')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
     
        Schema::create('Employment_Status', function (Blueprint $table) {
            $table->id();
            $table->string('Text')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function setupUncompleted(){
        
        Schema::create('Employment_StartAnnonces', function (Blueprint $table) {
            $table->id();
            $table->integer('Number');
            $table->integer('Year');
            $table->mediumText('Description')->nullable();
            $table->foreignId('Stage_id')->constrained(table: 'Employment_Stages')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Slug');
            $table->enum('Status',['Publish','Draft'])->default('Draft')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('Employment_Jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Code');
            $table->foreignId('Job_id')->constrained(table: 'Mosama_JobNames')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Slug');
            $table->integer('Count')->default(0);
            $table->date('AgeIn');
            $table->integer('Age');
            $table->enum('Driver',[0,1])->default(0);
            $table->enum('Status',['Publish','Draft'])->default('Publish');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_People', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('NID');
            $table->enum('Sex',[0,1])->default(1);
            $table->string('Fname');
            $table->string('Sname');
            $table->string('Tname');
            $table->string('Lname');
            $table->foreignId('LiveGov')->constrained(table: 'Governorates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('LiveCity')->constrained(table: 'Cities')->onUpdate('cascade')->onDelete('cascade');
            $table->mediumText('LiveAddress');
            $table->foreignId('BornGov')->constrained(table: 'Governorates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('BornCity')->constrained(table: 'Cities')->onUpdate('cascade')->onDelete('cascade');
            $table->date('BirthDate');
            $table->integer('AgeYears');
            $table->integer('AgeMonths');
            $table->integer('AgeDays');
            $table->string('ConnectLandline')->nullable();
            $table->string('ConnectMobile')->nullable();
            $table->string('ConnectEmail')->nullable();
            $table->foreignId('Health_id')->constrained(table: 'Employment_Health')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('MaritalStatus_id')->constrained(table: 'Employment_MaritalStatus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Arm_id')->constrained(table: 'Employment_Army')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Ama_id')->constrained(table: 'Employment_Ama')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Tamin');
            $table->jsonb('Khebra')->nullable();
            $table->foreignId('Education_id')->constrained(table: 'Mosama_Educations')->onUpdate('cascade')->onDelete('cascade');
            $table->year('EducationYear');
            $table->foreignId('Stage_id')->constrained(table: 'Employment_Stages')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('Result',[1,2]);
            $table->jsonb('Message')->nullable();
            $table->foreignId('DriverDegree')->constrained(table: 'Employment_Drivers')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->date('DriverStart')->nullable();
            $table->date('DriverEnd')->nullable();
            $table->string('FileName',255);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_PeopleNewData', function (Blueprint $table) {
            $table->id();
            $table->foreignId('People_id')->constrained(table: 'Employment_People')->onUpdate('cascade')->onDelete('cascade')->unique();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Fname');
            $table->string('Sname');
            $table->string('Tname');
            $table->string('Lname');
            $table->foreignId('LiveGov')->constrained(table: 'Governorates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('LiveCity')->constrained(table: 'Cities')->onUpdate('cascade')->onDelete('cascade');
            $table->mediumText('LiveAddress');
            $table->foreignId('BornGov')->constrained(table: 'Governorates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('BornCity')->constrained(table: 'Cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ConnectLandline')->nullable();
            $table->string('ConnectMobile')->nullable();
            $table->string('ConnectEmail')->nullable();
            $table->foreignId('Health_id')->constrained(table: 'Employment_Health')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('MaritalStatus_id')->constrained(table: 'Employment_MaritalStatus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Arm_id')->constrained(table: 'Employment_Army')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Ama_id')->constrained(table: 'Employment_Ama')->onUpdate('cascade')->onDelete('cascade');
            $table->string('Tamin');
            $table->float('Khebra',1,2)->nullable();
            $table->enum('Khebra_type',[0,1,2]);
            $table->foreignId('Education_id')->constrained(table: 'Mosama_Educations')->onUpdate('cascade')->onDelete('cascade');
            $table->year('EducationYear');
            $table->foreignId('Stage_id')->constrained(table: 'Employment_Stages')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('Result',[1,2]);
            $table->json('Message')->nullable();
            $table->foreignId('DriverDegree')->constrained(table: 'Employment_Drivers')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->date('DriverStart')->nullable();
            $table->date('DriverEnd')->nullable();
            $table->string('FileName',255);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_PeopleDegrees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('People_id')->constrained(table: 'Employment_People')->onUpdate('cascade')->onDelete('cascade');
            $table->float('Editorial',1,4);
            $table->float('Practical',1,4);
            $table->float('Interview',1,4);
            $table->timestamps();
            $table->softDeletes();
        }); 
        Schema::create('Employment_PeopleNewStage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('People_id')->constrained(table: 'Employment_People')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Status_id')->constrained(table: 'Employment_Status')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('Message');
            $table->foreignId('Stage_id')->constrained(table: 'Employment_Stages')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        
        
    }
    public function down(): void
    {
        Schema::dropIfExists('Employment_Ama');
        Schema::dropIfExists('Employment_Army');
        Schema::dropIfExists('Employment_Drivers');
        Schema::dropIfExists('Employment_Health');
        Schema::dropIfExists('Employment_IncludedFiles');
        Schema::dropIfExists('Employment_Instructions');
        Schema::dropIfExists('Employment_Jobs');
        Schema::dropIfExists('Employment_Jobs_Ama');
        Schema::dropIfExists('Employment_Jobs_Army');
        Schema::dropIfExists('Employment_Jobs_City');
        Schema::dropIfExists('Employment_Job_Driver');
        Schema::dropIfExists('Employment_Jobs_Educations');
        Schema::dropIfExists('Employment_Jobs_Health');
        Schema::dropIfExists('Employment_Jobs_IncludedFiles');
        Schema::dropIfExists('Employment_Jobs_Instructions');
        Schema::dropIfExists('Employment_Jobs_MaritalStatus');
        Schema::dropIfExists('Employment_Job_Mahata');
        Schema::dropIfExists('Employment_Jobs_Qualifications');
        Schema::dropIfExists('Employment_MaritalStatus');
        Schema::dropIfExists('Employment_Lagna');
        Schema::dropIfExists('Employment_LagnaPersons');
        Schema::dropIfExists('Employment_Lagna_Persons');
        Schema::dropIfExists('Employment_DinamicPages');
        Schema::dropIfExists('Employment_StaticPages');
        Schema::dropIfExists('Employment_People');
        Schema::dropIfExists('Employment_PeopleNewData');
        Schema::dropIfExists('Employment_PeopleDegrees');
        Schema::dropIfExists('Employment_PeopleNewStage');
        Schema::dropIfExists('Employment_Stages');
        Schema::dropIfExists('Employment_StartAnnonces');
        Schema::dropIfExists('Employment_StartAnnonce_Gov');
        Schema::dropIfExists('Employment_StartAnnonce_Qualification');
        Schema::dropIfExists('Employment_Qualifications');
        Schema::dropIfExists('Employment_Status');
        Schema::dropIfExists('Employment_Grievance');
    }
    public function rel(){
        Schema::create('Employment_Jobs_Ama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Ama_id')->constrained(table: 'Employment_Ama')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_Army', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Arm_id')->constrained(table: 'Employment_Army')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_City', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('City_id')->constrained(table: 'Cities')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Job_Driver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Driver_id')->constrained(table: 'Employment_Drivers')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_Educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Education_id')->constrained(table: 'Mosama_Educations')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_Health', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Health_id')->constrained(table: 'Employment_Health')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_IncludedFiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Inf_id')->constrained(table: 'Employment_IncludedFiles')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_Instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Instraction_id')->constrained(table: 'Employment_Instructions')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_MaritalStatus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('MaritalStatus_id')->constrained(table: 'Employment_MaritalStatus')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Job_Mahata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Mahata_id')->constrained(table: 'OrgStru_Mahatas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Jobs_Qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Job_id')->constrained(table: 'Employment_Jobs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Qualification_id')->constrained(table: 'Employment_Qualifications')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Lagna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('Type');
            $table->string('Text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_Lagna_Persons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Lagna_id')->constrained(table: 'Employment_Lagna')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Person_id')->constrained(table: 'Employment_LagnaPersons')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_StartAnnonce_Gov', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Gov_id')->constrained(table: 'Governorates')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('Employment_StartAnnonce_Qualification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Qualification_id')->constrained(table: 'Employment_Qualifications')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('Employment_Grievance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('People_id')->constrained(table: 'Employment_People')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Stage_id')->constrained(table: 'Employment_PeopleNewStage')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('Employment_Annonces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Annonce_id')->constrained(table: 'Employment_StartAnnonces')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('Text')->unique();
            $table->enum('Status',['Publish','Draft'])->default('Draft');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};