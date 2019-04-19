# coding: utf-8
from sqlalchemy import Column, DECIMAL, Float, String, TIMESTAMP, Table, text
from sqlalchemy.dialects.mysql import INTEGER
from sqlalchemy.ext.declarative import declarative_base

Base = declarative_base()
metadata = Base.metadata


class Abc(Base):
    __tablename__ = 'abc'

    id = Column(INTEGER(11), primary_key=True)
    payment_method = Column(String(191, 'utf8mb4_unicode_520_ci'))
    price_amount = Column(DECIMAL(10, 2))
    price_currency = Column(String(191, 'utf8mb4_unicode_520_ci'))
    sale_id = Column(INTEGER(11), index=True)
    shop_id = Column(INTEGER(11), index=True)
    type = Column(String(191, 'utf8mb4_unicode_520_ci'))
    signature = Column(String(191, 'utf8mb4_unicode_520_ci'))


t_lat = Table(
    'lat', metadata,
    Column('gps', Float),
    Column('map', Float)
)


t_lon = Table(
    'lon', metadata,
    Column('gps', Float),
    Column('map', Float)
)


class Pay(Base):
    __tablename__ = 'pay'

    id = Column(INTEGER(11), primary_key=True)
    m_id = Column(INTEGER(11), nullable=False)
    type = Column(INTEGER(11), nullable=False)
    startdate = Column(TIMESTAMP, server_default=text("CURRENT_TIMESTAMP"))
    enddate = Column(TIMESTAMP)
    cost = Column(DECIMAL(10, 0), nullable=False)
    create_time = Column(TIMESTAMP, server_default=text("CURRENT_TIMESTAMP"))


class Tt(Base):
    __tablename__ = 'tt'

    id = Column(INTEGER(11), primary_key=True)
    payment_method = Column(String(191, 'utf8mb4_unicode_520_ci'))
    price_amount = Column(DECIMAL(10, 2))
    price_currency = Column(String(191, 'utf8mb4_unicode_520_ci'))
    sale_id = Column(INTEGER(11), index=True)
    shop_id = Column(INTEGER(11), index=True)
    type = Column(String(191, 'utf8mb4_unicode_520_ci'))
    signature = Column(String(191, 'utf8mb4_unicode_520_ci'))
