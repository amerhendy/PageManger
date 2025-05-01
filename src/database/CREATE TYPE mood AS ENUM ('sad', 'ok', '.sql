CREATE TYPE mood AS ENUM ('sad', 'ok', 'happy');

DROP TABLE IF EXISTS "Employment_People";
DROP SEQUENCE IF EXISTS "Employment_People_id_seq";
CREATE SEQUENCE "Employment_People_id_seq";

CREATE TABLE "public"."Employment_People" (
    "id" bigint DEFAULT nextval('"Employment_People_id_seq"') NOT NULL,
    "Annonce_id" bigint NOT NULL,
    "Job_id" bigint NOT NULL,
    "NID" character varying(255) NOT NULL,
    "Sex" character varying(255) DEFAULT '1' NOT NULL,
    "Fname" character varying(255) NOT NULL,
    "Sname" character varying(255) NOT NULL,
    "Tname" character varying(255) NOT NULL,
    "Lname" character varying(255) NOT NULL,
    "LiveGov" bigint NOT NULL,
    "LiveCity" bigint NOT NULL,
    "LiveAddress" text NOT NULL,
    "BornGov" bigint NOT NULL,
    "BornCity" bigint NOT NULL,
    "BirthDate" date NOT NULL,
    "AgeYears" integer NOT NULL,
    "AgeMonths" integer NOT NULL,
    "AgeDays" integer NOT NULL,
    "ConnectLandline" character varying(255),
    "ConnectMobile" character varying(255),
    "ConnectEmail" character varying(255),
    "Health_id" bigint NOT NULL,
    "MaritalStatus_id" bigint NOT NULL,
    "Arm_id" bigint NOT NULL,
    "Ama_id" bigint NOT NULL,
    "Tamin" character varying(255) NOT NULL,
    "Khebra" json,
    "Education_id" bigint NOT NULL,
    "EducationYear" integer NOT NULL,
    "Stage_id" bigint NOT NULL,
    "Result" character varying(255) NOT NULL,
    "Message" json,
    "DriverDegree" bigint,
    "DriverStart" date,
    "DriverEnd" date,
    "FileName" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "Employment_People_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "Employment_People" ("id", "Annonce_id", "Job_id", "NID", "Sex", "Fname", "Sname", "Tname", "Lname", "LiveGov", "LiveCity", "LiveAddress", "BornGov", "BornCity", "BirthDate", "AgeYears", "AgeMonths", "AgeDays", "ConnectLandline", "ConnectMobile", "ConnectEmail", "Health_id", "MaritalStatus_id", "Arm_id", "Ama_id", "Tamin", "Khebra", "Education_id", "EducationYear", "Stage_id", "Result", "Message", "DriverDegree", "DriverStart", "DriverEnd", "FileName", "created_at", "updated_at", "deleted_at") VALUES
(30,	16,	29,	'28807051203034',	'1',	'عامر',	'هندى',	'على',	'عامر',	8,	98,	'مهد الحضارات',	4,	66,	'1988-07-05',	35,	4,	8,	'0502792155',	'01090018329',	'amer.hendy@yahoo.com',	2,	1,	1,	5,	'10000',	'["0","10"]',	1,	2010,	1,	'2',	'[{"Age":"JOBLANG::Employment_People.Age.Age"}]',	2,	'2020-10-12',	'2024-10-02',	'public/28807051203034.pdf',	'2023-10-13 22:03:04',	'2023-10-13 22:03:04',	NULL);

DROP TABLE IF EXISTS "Employment_PeopleNewData";
DROP SEQUENCE IF EXISTS "Employment_PeopleNewData_id_seq";
CREATE SEQUENCE "Employment_PeopleNewData_id_seq";

CREATE TABLE "public"."Employment_PeopleNewData" (
    "id" bigint DEFAULT nextval('"Employment_PeopleNewData_id_seq"') NOT NULL,
    "People_id" bigint NOT NULL,
    "Job_id" bigint NOT NULL,
    "Fname" character varying(255) NOT NULL,
    "Sname" character varying(255) NOT NULL,
    "Tname" character varying(255) NOT NULL,
    "Lname" character varying(255) NOT NULL,
    "LiveGov" bigint NOT NULL,
    "LiveCity" bigint NOT NULL,
    "LiveAddress" text NOT NULL,
    "BornGov" bigint NOT NULL,
    "BornCity" bigint NOT NULL,
    "ConnectLandline" character varying(255),
    "ConnectMobile" character varying(255),
    "ConnectEmail" character varying(255),
    "Health_id" bigint NOT NULL,
    "MaritalStatus_id" bigint NOT NULL,
    "Arm_id" bigint NOT NULL,
    "Ama_id" bigint NOT NULL,
    "Tamin" character varying(255) NOT NULL,
    "Khebra" json,
    "Education_id" bigint NOT NULL,
    "EducationYear" integer NOT NULL,
    "Stage_id" bigint NOT NULL,
    "Result" character varying(255) NOT NULL,
    "Message" text,
    "DriverDegree" bigint NOT NULL,
    "DriverStart" date,
    "DriverEnd" date,
    "FileName" character varying(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "Employment_PeopleNewData_pkey" PRIMARY KEY ("id")
) WITH (oids = false);
DROP TABLE IF EXISTS "Employment_PeopleNewStage";
DROP SEQUENCE IF EXISTS "Employment_PeopleNewStage_id_seq";
CREATE SEQUENCE "Employment_PeopleNewStage_id_seq";

CREATE TABLE "public"."Employment_PeopleNewStage" (
    "id" bigint DEFAULT nextval('"Employment_PeopleNewStage_id_seq"') NOT NULL,
    "People_id" bigint NOT NULL,
    "Status_id" bigint NOT NULL,
    "Message" text NOT NULL,
    "Stage_id" bigint NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" timestamp(0),
    CONSTRAINT "Employment_PeopleNewStage_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "Employment_PeopleNewStage" ("id", "People_id", "Status_id", "Message", "Stage_id", "created_at", "updated_at", "deleted_at") VALUES
(7,	30,	2,	'[{"Age":"JOBLANG::Employment_People.Age.Age","Khebra":"EMPLANG::Mosama_Experiences.singular"}]',	5,	'2023-10-16 23:17:27',	'2023-10-16 23:17:27',	NULL);

ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_ama_id_foreign" FOREIGN KEY ("Ama_id") REFERENCES "Employment_Ama"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_annonce_id_foreign" FOREIGN KEY ("Annonce_id") REFERENCES "Employment_StartAnnonces"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_arm_id_foreign" FOREIGN KEY ("Arm_id") REFERENCES "Employment_Army"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_driverdegree_foreign" FOREIGN KEY ("DriverDegree") REFERENCES "Employment_Drivers"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_health_id_foreign" FOREIGN KEY ("Health_id") REFERENCES "Employment_Health"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_maritalstatus_id_foreign" FOREIGN KEY ("MaritalStatus_id") REFERENCES "Employment_MaritalStatus"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_People" ADD CONSTRAINT "employment_people_stage_id_foreign" FOREIGN KEY ("Stage_id") REFERENCES "Employment_Stages"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_ama_id_foreign" FOREIGN KEY ("Ama_id") REFERENCES "Employment_Ama"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_arm_id_foreign" FOREIGN KEY ("Arm_id") REFERENCES "Employment_Army"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_driverdegree_foreign" FOREIGN KEY ("DriverDegree") REFERENCES "Employment_Drivers"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_health_id_foreign" FOREIGN KEY ("Health_id") REFERENCES "Employment_Health"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_maritalstatus_id_foreign" FOREIGN KEY ("MaritalStatus_id") REFERENCES "Employment_MaritalStatus"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewData" ADD CONSTRAINT "employment_peoplenewdata_stage_id_foreign" FOREIGN KEY ("Stage_id") REFERENCES "Employment_Stages"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

ALTER TABLE ONLY "public"."Employment_PeopleNewStage" ADD CONSTRAINT "employment_peoplenewstage_stage_id_foreign" FOREIGN KEY ("Stage_id") REFERENCES "Employment_Stages"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."Employment_PeopleNewStage" ADD CONSTRAINT "employment_peoplenewstage_status_id_foreign" FOREIGN KEY ("Status_id") REFERENCES "Employment_Status"(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;

-- 2023-10-17 17:59:39.520985+00
