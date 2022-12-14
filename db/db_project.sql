PGDMP                         z            produksi    14.1    14.1 '               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    67238    produksi    DATABASE     k   CREATE DATABASE produksi WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Indonesian_Indonesia.1252';
    DROP DATABASE produksi;
                postgres    false            ?            1259    83666 	   msproduct    TABLE     $  CREATE TABLE public.msproduct (
    productid integer NOT NULL,
    partnumber character varying(255) NOT NULL,
    productname character varying(255) NOT NULL,
    image character varying(255) NOT NULL,
    createddate timestamp without time zone NOT NULL,
    createdby integer NOT NULL
);
    DROP TABLE public.msproduct;
       public         heap    postgres    false            ?            1259    83665    msproduct_productid_seq    SEQUENCE     ?   CREATE SEQUENCE public.msproduct_productid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.msproduct_productid_seq;
       public          postgres    false    218                       0    0    msproduct_productid_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.msproduct_productid_seq OWNED BY public.msproduct.productid;
          public          postgres    false    217            ?            1259    67240    msuser    TABLE     |  CREATE TABLE public.msuser (
    userid integer NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    last_login timestamp without time zone,
    createddate timestamp without time zone NOT NULL,
    createdby character varying(255) NOT NULL,
    updateddate timestamp without time zone,
    updatedby character varying(255)
);
    DROP TABLE public.msuser;
       public         heap    postgres    false            ?            1259    67239    msuser_userid_seq    SEQUENCE     ?   CREATE SEQUENCE public.msuser_userid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.msuser_userid_seq;
       public          postgres    false    210                       0    0    msuser_userid_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.msuser_userid_seq OWNED BY public.msuser.userid;
          public          postgres    false    209            ?            1259    75482    productionorder    TABLE     [  CREATE TABLE public.productionorder (
    id integer NOT NULL,
    productid integer NOT NULL,
    ordernumber character varying(255) NOT NULL,
    batchnumber character varying(255) NOT NULL,
    location character varying(255),
    profcenter character varying(255),
    createddate timestamp without time zone NOT NULL,
    createdby character varying(255) NOT NULL,
    updateddate timestamp without time zone,
    updatedby character varying(255),
    orderdate timestamp without time zone NOT NULL,
    productiondate character varying(255) NOT NULL,
    exportdate timestamp without time zone
);
 #   DROP TABLE public.productionorder;
       public         heap    postgres    false            ?            1259    75481    productionorder_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.productionorder_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.productionorder_id_seq;
       public          postgres    false    214                       0    0    productionorder_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.productionorder_id_seq OWNED BY public.productionorder.id;
          public          postgres    false    213            ?            1259    75448    productionordersn    TABLE     ?   CREATE TABLE public.productionordersn (
    id integer NOT NULL,
    headerid integer,
    serialnumber character varying NOT NULL
);
 %   DROP TABLE public.productionordersn;
       public         heap    postgres    false            ?            1259    75447    productionordersn_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.productionordersn_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 /   DROP SEQUENCE public.productionordersn_id_seq;
       public          postgres    false    212                       0    0    productionordersn_id_seq    SEQUENCE OWNED BY     U   ALTER SEQUENCE public.productionordersn_id_seq OWNED BY public.productionordersn.id;
          public          postgres    false    211            ?            1259    75495    productionresult    TABLE     Y  CREATE TABLE public.productionresult (
    id integer NOT NULL,
    status integer NOT NULL,
    imgfile character varying(255) NOT NULL,
    txtfile character varying(255) NOT NULL,
    directory character varying(255) NOT NULL,
    createddate timestamp without time zone NOT NULL,
    createdby integer NOT NULL,
    snid integer NOT NULL
);
 $   DROP TABLE public.productionresult;
       public         heap    postgres    false            ?            1259    75494    productionresult_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.productionresult_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 .   DROP SEQUENCE public.productionresult_id_seq;
       public          postgres    false    216                       0    0    productionresult_id_seq    SEQUENCE OWNED BY     S   ALTER SEQUENCE public.productionresult_id_seq OWNED BY public.productionresult.id;
          public          postgres    false    215            t           2604    83669    msproduct productid    DEFAULT     z   ALTER TABLE ONLY public.msproduct ALTER COLUMN productid SET DEFAULT nextval('public.msproduct_productid_seq'::regclass);
 B   ALTER TABLE public.msproduct ALTER COLUMN productid DROP DEFAULT;
       public          postgres    false    218    217    218            p           2604    67243    msuser userid    DEFAULT     n   ALTER TABLE ONLY public.msuser ALTER COLUMN userid SET DEFAULT nextval('public.msuser_userid_seq'::regclass);
 <   ALTER TABLE public.msuser ALTER COLUMN userid DROP DEFAULT;
       public          postgres    false    209    210    210            r           2604    75485    productionorder id    DEFAULT     x   ALTER TABLE ONLY public.productionorder ALTER COLUMN id SET DEFAULT nextval('public.productionorder_id_seq'::regclass);
 A   ALTER TABLE public.productionorder ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    213    214    214            q           2604    75451    productionordersn id    DEFAULT     |   ALTER TABLE ONLY public.productionordersn ALTER COLUMN id SET DEFAULT nextval('public.productionordersn_id_seq'::regclass);
 C   ALTER TABLE public.productionordersn ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    211    212    212            s           2604    75498    productionresult id    DEFAULT     z   ALTER TABLE ONLY public.productionresult ALTER COLUMN id SET DEFAULT nextval('public.productionresult_id_seq'::regclass);
 B   ALTER TABLE public.productionresult ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216                      0    83666 	   msproduct 
   TABLE DATA           f   COPY public.msproduct (productid, partnumber, productname, image, createddate, createdby) FROM stdin;
    public          postgres    false    218   ?/                 0    67240    msuser 
   TABLE DATA           x   COPY public.msuser (userid, username, password, last_login, createddate, createdby, updateddate, updatedby) FROM stdin;
    public          postgres    false    210   )0                 0    75482    productionorder 
   TABLE DATA           ?   COPY public.productionorder (id, productid, ordernumber, batchnumber, location, profcenter, createddate, createdby, updateddate, updatedby, orderdate, productiondate, exportdate) FROM stdin;
    public          postgres    false    214   ?0                 0    75448    productionordersn 
   TABLE DATA           G   COPY public.productionordersn (id, headerid, serialnumber) FROM stdin;
    public          postgres    false    212   1                 0    75495    productionresult 
   TABLE DATA           q   COPY public.productionresult (id, status, imgfile, txtfile, directory, createddate, createdby, snid) FROM stdin;
    public          postgres    false    216   %1                  0    0    msproduct_productid_seq    SEQUENCE SET     F   SELECT pg_catalog.setval('public.msproduct_productid_seq', 28, true);
          public          postgres    false    217                        0    0    msuser_userid_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.msuser_userid_seq', 2, true);
          public          postgres    false    209            !           0    0    productionorder_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.productionorder_id_seq', 82, true);
          public          postgres    false    213            "           0    0    productionordersn_id_seq    SEQUENCE SET     I   SELECT pg_catalog.setval('public.productionordersn_id_seq', 2504, true);
          public          postgres    false    211            #           0    0    productionresult_id_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.productionresult_id_seq', 240, true);
          public          postgres    false    215            ~           2606    83673    msproduct msproduct_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.msproduct
    ADD CONSTRAINT msproduct_pkey PRIMARY KEY (productid);
 B   ALTER TABLE ONLY public.msproduct DROP CONSTRAINT msproduct_pkey;
       public            postgres    false    218            v           2606    67247    msuser msuser_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.msuser
    ADD CONSTRAINT msuser_pkey PRIMARY KEY (userid);
 <   ALTER TABLE ONLY public.msuser DROP CONSTRAINT msuser_pkey;
       public            postgres    false    210            z           2606    75489 $   productionorder productionorder_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.productionorder
    ADD CONSTRAINT productionorder_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.productionorder DROP CONSTRAINT productionorder_pkey;
       public            postgres    false    214            x           2606    75455 (   productionordersn productionordersn_pkey 
   CONSTRAINT     f   ALTER TABLE ONLY public.productionordersn
    ADD CONSTRAINT productionordersn_pkey PRIMARY KEY (id);
 R   ALTER TABLE ONLY public.productionordersn DROP CONSTRAINT productionordersn_pkey;
       public            postgres    false    212            |           2606    75502 &   productionresult productionresult_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.productionresult
    ADD CONSTRAINT productionresult_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.productionresult DROP CONSTRAINT productionresult_pkey;
       public            postgres    false    216               ?   x?u̻?0 ?ڞ??~?s??L?9qB(fBo?????????m?8??(??4/y??D???J???|r?`M?@?#u?Q??+?ۆq \???&?13ꟍ?s?m??V???f??Q??
Q,?????wl??w??7?         ?   x?mͻ?0@??}
V??)?l@c"A?@?"W?<?:?8??|E??R"	?D?T??'?????G?/{9?iq%m!ȡ?M?????d??Y??]?BmL?CC?~???Pߦ?/c?!??jêNo2????L??6/?S_???U??yݤ?????[???~?P?? ??;x            x?????? ? ?            x?????? ? ?            x?????? ? ?     