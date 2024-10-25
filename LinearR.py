import pandas as pd
from sklearn.linear_model import LinearRegression
import joblib


data = pd.read_csv('road_accidents.csv')


X = data[['weather_conditions', 'time_of_day', 'road_type', 'vehicle_type', 'driver_age', 'num_vehicles']]
y = data['accident_severity']

model = LinearRegression()
model.fit(X, y)

joblib.dump(model, 'accident_severity_model.pkl')
