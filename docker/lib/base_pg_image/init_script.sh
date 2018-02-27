#!/bin/bash

. /etc/profile

if [ ! -f "$PGDATA/postgresql.conf" ]; then

  /usr/pgsql-9.6/bin/postgresql96-setup initdb

  sed -i -E "s|^#listen_address.+?|listen_addresses = '*'|" /var/lib/pgsql/data/postgresql.conf
  cat /opt/etc_base/pg_hba.conf >/var/lib/pgsql/data/pg_hba.conf

  service postgresql-9.6 start

  sudo -u postgres psql -U postgres -d postgres -c "alter user postgres with password 'postgres';"

  psql --user=postgres postgres </opt/sql/recreate_dbs.sql

  ./usr/bin/custom_init_script.sh

else
  service postgresql-9.6 start
fi
