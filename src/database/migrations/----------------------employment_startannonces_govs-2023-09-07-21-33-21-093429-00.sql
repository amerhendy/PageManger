DROP TABLE IF EXISTS "Employment_StartAnnonces_Governorates";
DROP SEQUENCE IF EXISTS Employment_StartAnnonces_Governorates_id_seq;
CREATE SEQUENCE Employment_StartAnnonces_Governorates_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;
CREATE TABLE "Employment_StartAnnonces_Governorates" (
    "id" integer DEFAULT nextval('Employment_StartAnnonces_Governorates_id_seq') NOT NULL,
    "Annonce_id" integer NOT NULL,
    "Governorate_id" integer NOT NULL,
    "created_at" timestamp DEFAULT now(),
    "updated_at" timestamp,
    "deleted_at" timestamp,
    CONSTRAINT "Employment_StartAnnonces_Governorates_pkey" PRIMARY KEY ("id")
) WITH (oids = false);
CREATE INDEX "st_go_indexs" ON "Employment_StartAnnonces_Governorates" USING btree ("Annonce_id", "Governorate_id");
ALTER TABLE ONLY "Employment_StartAnnonces_Governorates" ADD CONSTRAINT "e_sa_g_Annonce_id_f_k" FOREIGN KEY ("Annonce_id") REFERENCES "Employment_StartAnnonces"(id) ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE;
ALTER TABLE ONLY "Employment_StartAnnonces_Governorates" ADD CONSTRAINT "e_sa_g_Governorate_id_f_k" FOREIGN KEY ("Governorate_id") REFERENCES "Governorates"(id) ON UPDATE CASCADE NOT DEFERRABLE;
