
model = joblib.load('accident_severity_model.pkl')


hypothetical_data = pd.DataFrame({
    'weather_conditions': [1], 
    'time_of_day': [14],        
    'road_type': [2],           
    'vehicle_type': [1],     
    'driver_age': [35],      
    'num_vehicles': [2]         
})


predicted_severity = model.predict(hypothetical_data)
print(predicted_severity)
